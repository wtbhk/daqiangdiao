$(function () {
    //列表项模板
    var template = '<tr class="template-upload fade in">'+
        '<td>'+
            '<span class="preview"><canvas width="46" height="80"></canvas></span>'+
        '</td>'+
        '<td>'+
           ' <p class="name">${fileName_}</p>  '+          
        '</td>'+
        '<td>'+
        '    <p class="size">${fileSize_} KB</p>'+
        '    <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>'+
        '</td>'+
        '<td>'+
        '    <button class="btn btn-primary start">'+
        '       <i class="icon-upload icon-white"></i>'+
        '       <span>Start</span>'+
        '    </button>'+
        '    <button class="btn btn-warning cancel">'+
        '       <i class="icon-ban-circle icon-white"></i>'+
        '       <span>Cancel</span>'+
        '    </button>        '+    
        '</td>'+
    '</tr>';
    var url = 'http://localhost:8080/myfileupload/upload';
    var currentData = {};
    $('#fileupload').fileupload({autoUpload: true,
        url: url,
        dataType: 'json',
        add: function (e, data) {
           var templateImpl = $.tmpl(template,{"fileName_":data.files[0].name,"fileSize_":(data.files[0].size/1000).toFixed(2)}).appendTo( ".files" );
           data.content = templateImpl;
           $(".start", templateImpl).click(function () {
                currentData.bar = templateImpl;             
                $('<p/>').text('Uploading...').addClass("uploading").replaceAll($(this));
                data.submit();//上传文件
           });
           $(".cancel", templateImpl).click(function () {
                $('<p/>').text('cancel...').replaceAll($(this));
                data.abort();//取消上传
                $(templateImpl).remove();
           });
        },

        done: function (e, data) {
            $(".uploading", data.content).text('上传成功');
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.bar', currentData.bar).css(
                'width',
                progress + '%'
            );
        }
    });
});