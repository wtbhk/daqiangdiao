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
            if (num.eq(i).text()*1 > rest.eq(i).text()*1)
                items.eq(i).addClass('warning');
        };
        items.find('span.delNum').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1 - 1;
            var idx = items.find('span.delNum').index(this);
            if (num === -1) return;
            number.text(num);
            $('input[name="items[' + idx +'][qty]"').val(num);
            console.log($('input[name="items[' + idx +'][qty]"').val());
            return rest.eq(idx).text()*1 < num ?
                items.eq(idx).addClass('warning') :
                items.eq(idx).removeClass('warning');
        });
        items.find('span.price').on('click', function () {
            var number = $(this).siblings('span.number');
            var num = number.text()*1 + 1;
            var idx = items.find('span.price').index(this);
            if ( num > rest.eq(idx).text()*1) return;
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
            $('input[name="time"]').val($(this).val());
            $('input[name="today"]').val('false');
        });
        $('#now').click(function () {
            $('input[name="time"]').val('');
            $('input[name="today"]').val('true');
            $('form').eq(0).submit();
        });
        $('body').on('click', 'button.ui-datepicker-close', function () {
            $('form').eq(0).submit();
        })
    }());
});