$(document).ready(function () {


    var suf = $('#admin_suf').val();


    var MassUpdate = {};
    MassUpdate = {
        linkMassUpdate: '[data-role=link-mass-update]',

        init: function() {
            $(document).on('change', 'table input:checkbox', this.checkSelectedRows);
        },
        checkSelectedRows: function () {
            var modelsId = [];
            var empty = true;
            $('table input:checkbox').each(function () {
                var checkbox = this;
                if ($(checkbox).prop("checked") === true) {
                    empty = false;
                    return false;
                }
            });

            $('table input:checkbox:checked').each(function(){
                modelsId.push($(this).val());
            });

            if (empty === false) {
                $('#rccform-modelsid').val(modelsId.join(','));
                $('.mass-update-btn').removeClass( "disabled");
            } else {
                $('#rccform-modelsid').val('');
                $('.mass-update-btn').addClass("disabled");
            }
        }
    };

    MassUpdate.init();




    /*	$('#details-category').change(function () {
            var Select2 = $('#details-parts_id');
            $.ajax({
                url: "/admin/index.php/details/search-parts",
                data: {
                    "categoryId": $(this).val()
                },
                dataType: "json",
            }).then(function (data) {
                Select2.find('option').remove();
                $.each(data, function (key, f) {
                    var option = new Option(f.text, f.id, true, true);
                    Select2.append(option);

                });
                Select2.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        });*/

    $(".gallery-btn").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var type = $(this).data("type");
        $.post('/'+suf+'/' + type + '/gallery-ajax', {
            id: id
        }, function (response) {
            $('#gallery').html(response);

            var options = {
                "container": "#gallery_slider_" + id
            };
            var links = $('#gallery_' + id).find('a.gallery-item');
            options.index = 0;
            blueimp.Gallery(links, options);


        });
    });

    $(".site-view-btn").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var type = $(this).data("type");
        $.post('/'+suf+'/' + type + '/site-view', {
            id: id
        }, function (response) {
            window.open(response);
        });
    });


    $(".download-img").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var num = parseInt($(this).data("num"));
        for (var i = 1;i <= num; i++)
        {
            window.open('/'+suf+'/details/avito-image-download/'+id+'/'+i);
        }
    });


    $("body").on("click", ".price-refresh", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.post($(this).attr('href'), {
            id: id
        }, function (response) {
            $.pjax.reload({
                container: '#sales_grid'
            });
        });
    });


    $(".cancel-sale").click(function (e) {
        e.preventDefault();
        var form = $('#sale_cancel');
        krajeeDialogCancelSale.prompt({label:'Причина возврата', value: '',maxlength: 100}, function (result) {
            if (result && result.length > 0) {
                $('#reason').val(result);
                form.submit();
            }
            else
                krajeeDialog.alert('Нужно заполнить причину');
        });



    });






    $("body").on("click", ".sale-detail-view-return", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            url = $(this).attr('href'),sale_id = $(this).data("sale-id");
        krajeeDialogCust.prompt({label:'Причина возврата', value: '',maxlength: 100}, function (result) {
            if (result && result.length > 0) {
                $.post(url, {
                    id: id,
                    sale_id: sale_id,
                    action: 'del-sale',
                    'comment' : result
                }, function (data) {

                    console.log(parseInt(data) == 0);
                    if (parseInt(data) == 0)
                        document.location.reload(true);
                    else {
                        $.pjax.reload({
                            container: '#sales_view_grid'
                        });
                    }
                })
            }
            else
                krajeeDialog.alert('Нужно заполнить причину');
        });

    });

    $("body").on("click", ".sale-detail-view-delete", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            url = $(this).attr('href'),sale_id = $(this).data("sale-id");
        BootstrapDialog.confirm({
            title: 'Подтверждение',
            message: 'Точно утилизировать деталь?',
            type: BootstrapDialog.TYPE_DANGER,
            closable: true,
            btnCancelLabel: 'Отмена',
            btnOKLabel: 'Утилизировать',
            btnOKClass: 'btn-danger',
            callback: function (result) {
                if (result) {
                    $.post(url, {
                        id: id,
                        sale_id: sale_id,
                        action: 'utilize'
                    }, function (data) {

                        console.log(parseInt(data) == 0);
                        if (parseInt(data) == 0)
                            document.location.reload(true);
                        else {
                            $.pjax.reload({
                                container: '#sales_view_grid'
                            });
                        }
                    })
                }

            }
        });


    });


    $("body").on("click", ".sale-detail-delete", function (e) {
        e.preventDefault();
        var idToRemove = $(this).data("id").toString(),
            id = $(this).data("id"),
            url = $(this).attr('href');
        var $select = $('#sales-details');

        var values = $select.val();
        if (values) {
            var i = values.indexOf(idToRemove);
            if (i >= 0) {
                values.splice(i, 1);
                $select.val(values).change();
                $.post(url, {
                    id: id,
                    action: 'del'
                }, function (data) {
                    $.pjax.reload({
                        container: '#sales_grid'
                    });
                }, 'json');
            }
        }
    });

});