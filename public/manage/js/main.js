$(document).ready(function () {
    //file upload
    (function () {
        if ($('input.fileupload').length === 0) return;
        var template = '<tr class="template-upload fade in">'+
            '<td>'+
                '<span class="preview"><img width="46" height="80" src="${imgSrc_}"></span>'+
            '</td>'+
            '<td>'+
               ' <p class="name">${fileName_}</p>  '+          
            '</td>'+
            '<td>'+
            '    <button class="btn btn-primary start">'+
            '       <span>上传</span>'+
            '    </button>'+
            '    <button class="btn btn-warning cancel">'+
            '       <span>取消</span>'+
            '    </button>        '+    
            '</td>'+
        '</tr>';
        var currentData = {};
        $('input.fileupload').on('click', function () {
            currentData.id = $(this).parent().parent().parent().attr('id');
        });
        $('input.fileupload').fileupload({autoUpload: true,
            url: '/admin/product/' + currentData.id + '/image',
            dataType: 'json',
            add: function (e, data) {
                data.url = '/admin/product/' + currentData.id + '/image';

                if (data.files && data.files[0]) {
                    var idx = $('input.fileupload').index(this);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        currentData.src =  e.target.result;
                        var templateImpl = $.tmpl(template,
                            {
                                "fileName_":data.files[0].name,
                                "fileSize_":(data.files[0].size/1000).toFixed(2),
                                "imgSrc_":currentData.src
                            }).appendTo( ".files:eq(" + idx + ")" );
                        data.content = templateImpl;
                        $(".start", templateImpl).click(function () {
                            currentData.bar = templateImpl;             
                            $('<p/>').text('上传中...').addClass("uploading").replaceAll($(this));
                            data.submit();//上传文件
                        });
                        $(".cancel", templateImpl).click(function () {
                            $('<p/>').text('取消中...').replaceAll($(this));
                            data.abort();//取消上传
                            $(templateImpl).remove();
                        });
                    }
                    reader.readAsDataURL(data.files[0]);
                }
            },

            done: function (e, data) {
                $(".uploading", data.content).text('上传成功');
                var imgTmpt = '<li><img src="' + currentData.src + '" alt=""></li>';
                $(this).parent().parent().siblings('.imglist').children().append(imgTmpt);
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.bar', currentData.bar).css(
                    'width',
                    progress + '%'
                );
            }
        });
    }());
    
    //change
    (function () {
        var tbody = $('#score tbody').eq(0);
        if (tbody.length === 0) return;
        tbody.on('click', 'input.change', function (e) {
            e.preventDefault();
            var par = $(this).parent().parent();
            par.find('input').removeAttr('disabled');
            par.prev().find('input').removeAttr('disabled');
            $(this).addClass('hidden').next().removeClass('hidden');
            par.find('input.del').addClass('hidden').next().removeClass('hidden');
        });

        tbody.on('click', 'input.del', function (e) {
            e.preventDefault();
            var par = $(this).parent().parent();
            var id = par.attr('id');
            if (!id) {
                return par.prev().remove()
                    .end().remove()
            }
            $.ajax({
                url: '/admin/product/' + id,
                type: 'DELETE'
            }).done(function (data) {
                $('#' + id).prev().remove();
                $('#' + id).remove();
            });
        });


        tbody.on('click', 'input.save', function (e) {
            e.preventDefault();
            var par = $(this).parent().parent();
            var idx = $('input.save').index(this);
            par.find('input').attr('disabled', 'disabled');
            par.prev().find('input').attr('disabled', 'disabled');
            $(this).addClass('hidden').prev().removeClass('hidden').removeAttr('disabled');
            par.find('input.chanle').addClass('hidden').prev().removeClass('hidden').removeAttr('disabled');
            var data ={
                'id': par.attr('id'),
                'price': $('input[name="price"').eq(idx).val(),
                'reservation_day': $('input[name="reservation_day"').eq(idx).val(),
                'inventory_per_day': $('input[name="inventory_per_day"').eq(idx).val(),
                'ignore_inventory': $('input[type="checkbox"').eq(idx).prop('checked'),
                'title': $('input[name="title"').eq(idx).val(),
                'description': $('input[name="description"').eq(idx).val(),
                'content': $('input[name="content"').eq(idx).val(),
                'rank': $('input[name="rank"').eq(idx).val()
            }
            $.ajax({
                url: '/admin/product',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (data) {
                    if(par.attr('id') === undefined) par.attr('id', data.product.id);
                }
            });
        });

        tbody.on('click', 'input.chanle', function (e) {
            e.preventDefault();
            var par = $(this).parent().parent();
            par.find('input').attr('disabled', 'disabled');
            par.prev().find('input').attr('disabled', 'disabled');
            $(this).addClass('hidden')
                .prev().removeClass('hidden').removeAttr('disabled');
            par.find('input.save').addClass('hidden')
                .prev().removeClass('hidden').removeAttr('disabled');
        });

        $('#new').click(function () {
            if (!tbody.find('tr:eq(1)').attr('id')) return;
            tbody.find('tr:eq(1)').clone(true).prependTo(tbody);
            tbody.find('tr:eq(1)').clone(true).prependTo(tbody);
            tbody.find('tr:eq(0) input[type="text"]').val('');
            tbody.find('tr:eq(1)').removeAttr('id');
        });

        tbody.on('click', '.imglist img', function (e) {
            var ts = $(this);
            var imgId = ts.attr('id');
            
            $.ajax({
                url: '/admin/product/' + ts.parent().parent().parent().parent().attr('id') + 'image/' + ts.attr('id'),
                type: 'DELETE',
            }).done(function (data) {
                ts.fadeOut(500, function () {
                    ts.remove();
                });
            });
        });
    }());
    
    //订单浏览
    (function () {
        var newOrder = $('div.wait');
        if (newOrder.length === 0) return;
/*        var tmpl = '<li>' + 
                '<ul class="unstyled fl">' + 
                    '<li><span class="fl">收件人</span><span class="fr">' + ${name} + '</span></li>' + 
                    '<li><span class="fl">电话</span><span class="fr">' + ${phoneNumber} + '</span></li>' +
                    '<li><span class="fl">地址</span><span class="fr">' + ${address} + '</span></li>' +
                    '<li><span class="fl">下单日期</span><span class="fr"'> + ${time} + '</span></li>' +
                    '<li><span class="fl">送达时间</span><span class="fr">' + ${get_time} + '</span></li>' +
                '</ul>' +
                '<ul class="unstyled fr">' +
                    '<li><span class="fl">' + ${foodName} + '</span><span>' + ${order} + '</span><span class="fr">' + ${price} + '</span></li>' + 
                    '<li><span class="fl">总价</span><span class="fr">' + ${total_price} + '</span></li>' + 
                    '<li><span class="fl">在线支付</span><span class="fr">' + ${tof} + '</span></li>' +
                '</ul>' + 
                '<div class="btn-group">' +
                    '<button class="btn btn-danger cOrder" type="button">关闭</button>' +
                    '<button class="btn btn-primary rOrder" type="button">接受</button>' +
                '</div>' +
            '</li>';
*/      newOrder.find('button.cOrder a').add('button.rOrder a')
            .on('click', function (e) {
            e.preventDefault();
            $.get($(this).attr('href'), function (data) {
                location.reload();
            });
        });
    }());
    
    (function(){
        var userM = $('#userManager') || 0;
        if (userM.length === 0) return;
        $('.change').on('click', function () {
            var ts = $(this);
            var balance = ts.parent().prev().children();
            var id = ts.parent().siblings().first().children().val();
            if (ts.hasClass('saveChange')) {
                ts.val('正在保存');
                $('form.hidden').attr('action', 'user/' + id)
                    .children('input.real-balance').val(balance.val())
                    .end().submit();
            } else {
                ts.val('保存').addClass('saveChange');
                balance.removeAttr('disabled');
            }
        });
    }());
});

