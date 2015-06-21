$(document).ready(function () {
    //模态框
    var modal = $('#modal');
    $('#modalClose').add('#mask').on('click', function () {
        modal.hide();
    });
    //footer 点击变色兼容
    //返回到上一页
    $('.headBack').on('click', function (e) {
        e.preventDefault();
        history.back();
    });
    function deal(qty, id) {
        $.post('/editcart', 
            { 
                'qty': qty,
                'id': id
            }, 
            function (data) {return console.log(data);}
        );   
    }
    $('.imgbox').on('click', 'li', function () {
        var ts = $(this);
        deal(1, ts.attr('id'));
        ts.append('<span class="checked" href=""><i class="fa fa-check fa-2x"></i></span>');
    });
    $('.imgbox').on('click', 'span.checked', function (event) {
        event.stopPropagation();
        var ts = $(this);
        deal(0, ts.parent().attr('id'));
        ts.remove();
    });
    $('.imgbox').on('click', '.s', function (event) {
        event.stopPropagation();
    });
        XBack.listen(function(){
/*
            history.back();
            location.reload();*/
        });

    //添加购物车
    (function(){
        var items = $('#product');
        if (!items.length) return;
        var need = $('span.needPrice').text()*1, //起送金额
            delivery = $('.delivery');           //起送按钮
        $('span.del').on('click', function () {
            var ts = $(this),
                number = ts.siblings('span.number'),
                num = number.text()*1,
                change = ts.siblings('span.price').text().substring(1)*1;
            if (!num) return;
            deal(num - 1, $(this).parent().attr('id'));
            number.text(num - 1);
            need += change;
        });
        $('span.price').on('click', function () {
            var ts = $(this),
                number = ts.siblings('span.number'),
                num = number.text()*1,
                change = ts.text().substring(1)*1;
            deal(num + 1, $(this).parent().attr('id'));
            number.text(num + 1);
            need -= change;
        });
    }());
    //购物车页面
    (function () {
        var cart = $('#cart');
        if (!cart.length) return;
        //监听物理返回键
/*        (function () {
            var state = ['/temp/store/productlist.html'];
            history.pushState(state, null, location.href);
            $(window).on('popstate', function(event) {
                var path =  window.location.pathname;
                event.originalEvent.state = '';
                alert(path);
                //state && location.reload();
                state && alert('test');
            });    
        }());*/

        var items = $('#list .order'),
            rest = items.find('strong.liu'),
            num  = items.find('span.number');
        items.find('span.delNum').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1;
            var idx = items.find('span.delNum').index(this);
            if (!num) return;
            number.text(num - 1);
            $('input[name="items[' + idx +'][qty]"').val(num - 1);
            deal(num - 1, $(this).parent().attr('id'));
        });
        items.find('span.price').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1;
            var idx = items.find('span.price').index(this);
            if (num + 1 > rest.eq(idx).text()*1) return;
            number.text(num + 1);
            $('input[name="items[' + idx +'][qty]"').val(num + 1);
            deal(num + 1, $(this).parent().attr('id'));      
        });

        $('#now').click(function () {
            $('input[name="date"]').val('');
            $('input[name="today"]').val('true');
            $('form').eq(0).attr('method', 'GET');
            $('form').eq(0).submit();
        });
        //确认订单
        $('#sub').on('click', function (e) {
            e.preventDefault();
            $('form').eq(0).submit();
        });
        $('li.selectTime').on('click', function () {
            var offset = $(this).offset();
            $('#timepicker').removeClass('hidden');
            $('#time').datetimepicker('show')
        });
        $('#time').change(function () {
            $('input[name="today"]').val('false');
            $('form').eq(0).attr('method', 'GET');
            $('form').eq(0).submit();
        });
        $('#time').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            weekStart: 0,
            autoclose: 1,
            todayHighlight: 1,
            todayBtn: 1,
            startDate: new Date()
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

    //晒单
    (function () {
        var shai = $('#shai');
        if(shai.length === 0) return;
        if($('#scroll').length !== 0) $(document).scrollTop(parseInt(shai.css('height')));

        $('#img_upload').on('click', function () {
            $('#file').trigger('click');
        });
        $('#file').on('change', function () {
            var obj = $(this)[0].files[0];
            window.URL = window.URL || window.webkitURL;
            $('#before').addClass('hidden')
                .next().removeClass('hidden')
                    .children('img').attr('src', window.URL.createObjectURL(obj) );
        });
    })();

    (function () {
        var productlist = $('#productlist');
        if(productlist.length === 0) return;

        //history.back()
    } ());
});
;!function(pkg, undefined){
    var STATE = 'x-back';
    var element;

    var onPopState = function(event){
        console.log(event.state === STATE, history.state)
        event.state === STATE && fire();
    }

    var record = function(state){
        history.pushState(state, null, location.href);
    }

    var fire = function(){
        var event = document.createEvent('Events');
        event.initEvent(STATE, false, false);
        element.dispatchEvent(event);
    }

    var listen = function(listener){
        element.addEventListener(STATE, listener, false);
    }

    !function(){
        element = document.createElement('span');
        window.addEventListener('popstate', onPopState);
        this.listen = listen;
        record(STATE);
    }.call(window[pkg] = window[pkg] || {});

}('XBack');