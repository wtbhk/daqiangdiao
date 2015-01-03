$(document).ready(function () {
    //模态框
    var modal = $('#modal');
    $('#modalClose').add('#mask').on('click', function () {
        modal.hide();
    });
    //添加购物车
    (function(){
        var items = $('#list li.order');
        if (items.length) return;
        var needPrice = $('span.needPrice');
        var need = needPrice.text()*1;
        $('span.del').on('click', function () {
            var number = $(this).siblings('span.number'),
                price = $(this).siblings('span.price');
            var num = number.text()*1,
                change = price.text().substring(1)*1;
            if (!num) return;
            $.post('/editcart', 
                {
                    'id': $(this).parent().attr('id'), 
                    'qty': num - 1
                }, 
                function () {return;}
            );
            number.text(num - 1);
            need += change;
            return need > 0 ? needPrice.text(need)
                : needPrice.text(0);
        });
        $('span.price').on('click', function () {
            var number = $(this).siblings('span.number'),
                price = $(this);
            var num = number.text()*1,
                change = price.text().substring(1)*1;
            if ( num + 1 > $('span.remain strong').text()*1) return;
            $.post('/editcart', 
                {
                    'id': $(this).parent().attr('id'), 
                    'qty': num + 1
                }, 
                function () {return;}
            );
            number.text(num + 1);
            need -= change;
            return need > 0 ? needPrice.text(need - change)
                : needPrice.text(0);
        });
    }());
    //购物车页面
    (function () {
        var items = $('#list li.order');
        if (!items.length) return;
        console.log("sss");
        var rest = items.find('strong'),
            num  = items.find('span.number');
        for (var i = num.length - 1; i >= 0; i--) {
            if (!rest.eq(i).hasClass('day')) {
                if (num.eq(i).text()*1 > rest.eq(i).text()*1)
                    items.eq(i).addClass('warning');  
            } else {
                items.eq(i).addClass('warning'); 
            }

        };
        items.find('span.delNum').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1 - 1;
            var idx = items.find('span.delNum').index(this);
            //提前天数不足
            if (!rest.eq(i).hasClass('day')) {
                if (num === -1) return;
                number.text(num);
                $('input[name="items[' + idx +'][qty]"').val(num);
                return rest.eq(idx).text()*1 < num ?
                    items.eq(idx).addClass('warning') :
                    items.eq(idx).removeClass('warning');
            } else {
                $('input[name="items[' + idx +'][qty]"').val(num);
                return num === -1 ? items.eq(idx).removeClass('warning') : false;
            }

        });
        items.find('span.price').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1 + 1;
            var idx = items.find('span.price').index(this);
            if (rest.eq(i).hasClass('day')) return;
            if (num > rest.eq(idx).text()*1) return;
            number.text(num);
            $('input[name="items[' + idx +'][qty]"').val(num);
                        console.log($('input[name="items[' + idx +'][qty]"').val());
        });
        $('li.selectTime').on('click', function () {
            $('#time').show();
            $('#time').datetimepicker({
                timeFormat: "HH:mm:ss",
                dateFormat: "yy-mm-dd"
            });
        });
        $('#time').change(function () {
            $('input[name="date"]').val($(this).val());
            $('input[name="today"]').val('false');
        });
        $('#now').click(function () {
            $('input[name="date"]').val('');
            $('input[name="today"]').val('true');
            $('form').eq(0).attr('method', 'GET');
            $('form').eq(0).submit();
        });
        $('body').on('click', 'button.ui-datepicker-close', function () {
            $('form').eq(0).attr('method', 'GET');
            $('form').eq(0).submit();
        });
        $('#sub').on('click', function (e) {
            e.preventDefault();
            $('form').eq(0).submit();
        });
    }());
    //付款页
    (function () {
        var checkorder = $('#checkorder');
        if (checkorder.length === 0) return;
        $('#payment').on('click', function () {
            var sub = $(this).find('.fr');
            var inp = $('input[name="payment"]');
            var bal = $('#balance').find('.fr');
            sub.addClass('checked');
            bal.removeClass('checked');
            inp.val('cash');
        });
        $('#balance').on('click', function () {
            var sub = $('#payment').find('.fr');
            var inp = $('input[name="payment"]');
            var bal = $(this).find('.fr');
            sub.removeClass('checked');
            bal.addClass('checked');
            inp.val('balance');
        });
        $('#subCheckOrder').on('click', function (e) {
            e.preventDefault();
            checkorder.submit();
        });
    }());
    //orderAddr 
    (function () {
        var orderAddr = $('#orderAddr');
        if (orderAddr.length === 0) return;
        $('li.addr').on('click', function () {
            var addrId = $(this).find('.address').attr('id');
            var par = $(this);
            $.post('/orderaddr', {
                'id': addrId
            }, function (data) {
                return !data['error'] ? 
                    par.find('.fr').addClass('checked')
                        .end().siblings('.addr').find('.fr').removeClass('checked') :
                    false;
            }, 'json');
        });
    }());
});