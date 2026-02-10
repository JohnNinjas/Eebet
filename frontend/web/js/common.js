$(function () {


    $('#view_modal').on('hidden.bs.modal', function () {

        var inFifteenMinutes = new Date(new Date().getTime() + 5 * 60 * 1000);
        Cookies.set('view-modal', '1', {
            expires: inFifteenMinutes
        });
    });

    function ChangeVote(num) {
        let counter = $(".js-counter"), n = parseInt(num);
        counter.removeClass('negative').removeClass('positive');
        if (n > 0 ) {
            counter.addClass('positive');
        } else if (n < 0) {
            counter.addClass('negative');
        }
        counter.html(n);
    }

    $(".js-vote").click(function (e) {
        e.preventDefault();
        let btn = $(this) ,id = btn.parent().data('id'),type = btn.data('type');
        $.post('/vote/'+id+'/'+type+'/', {}, function (response) {
            if (response.hasOwnProperty('success')) {
                console.log(response)
                $('.js-vote').get().forEach(function (entry) {
                    $(entry).removeClass('like-active');
                    $(entry).removeClass('dislike-active');
                });
                if (response.add) {
                    console.log('add ok')
                    if (type == 1) {
                        btn.addClass('like-active');
                    } else if (type == 2) {
                        btn.addClass('dislike-active');
                    }
                }
                ChangeVote(response.success);

            }
        });
    });



    $(".itemArticles__info.vip .buy").click(function (e) {
        e.preventDefault();
        var id = $(this).data('id'), price = $(this).data('price'), title = $(this).data('title');
        $.post('/payment/payment-form/', {}, function (response) {
            $('#modals').html(response);
            $('#payment_title').html(title);
            $('#invoiceform-price').val(price);
            $('#invoiceform-forecast_id').val(id);
            $('#buy').modal('show')
        });
    });

    $("#screenItem_director").waypoint(function () {

        $(".photoDirector").addClass("on");
    }, {
        offset: "60%"
    });

    $("#screenItem_why").waypoint(function () {

        $("#screenItem_why .title_image__text").addClass("animatedDown");
        $("#screenItem_why .hiddenText").addClass("off");

    }, {
        offset: "40%"
    });

    $("#screenItem_who").waypoint(function () {

        $("#screenItem_who .hiddenBlock").addClass("off");
        $("#screenItem_who .title_image__text").addClass("animatedDown");
        $("#screenItem_who .hiddenText").addClass("off");

    }, {
        offset: "40%"
    });

    $("#screenItem_start").waypoint(function () {

        $("#screenItem_start .hiddenBlock").addClass("off");
        $("#screenItem_start .title_image__text").addClass("animatedDown");
        $("#screenItem_start .hiddenText").addClass("off");

    }, {
        offset: "40%"
    });

    $("#cardsWrap").waypoint(function () {

        $(".cardsWrap").addClass("animatedBlock");


        setTimeout(() =>  $(".cardItem__btn").addClass("showBtn"), 1000);


    }, {
        offset: "40%"
    });

    $(".toggleMenu").click(function () {
        $(".mobileMenu").toggleClass("active_menu");
        $(this).toggleClass("toggleClose");
    });
});


