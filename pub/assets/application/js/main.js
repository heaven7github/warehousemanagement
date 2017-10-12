var baseHref = document.getElementsByTagName('base')[0].href

$(document).ready(function(){


    $('#manage_warehouse_btn').click(function (){
        document.location.href = baseHref + 'index.php?c=warehouse';
    });

    $('#simulation_btn').click(function (){
        document.location.href = baseHref + 'index.php?c=simulation';
    });

    $('#product_btn').click(function (){
        document.location.href = baseHref + 'index.php?c=product';
    });

    $('#add_warehouse').click(function (){
        document.location.href = baseHref + 'index.php?c=warehouse&a=add_warehouse';
    });

    $('.warehouse_product').click(function (){
        document.location.href = baseHref + 'index.php?c=warehouse&a=warehouse_product&id='+$(this).data('id');
    });

    $('.start_simulation').click(function (){
        document.location.href = baseHref + 'index.php?c=simulation&a=start&type='+$(this).data('id');
    });

    $('.remove_product').click(function (){
        var product_id = $(this).data('id');
        var warehouse_id = $('#id').val();
        var qty = $('#remove_product_id_' + product_id).val();
        document.location.href = baseHref + 'index.php?c=warehouse&a=remove_product&product_id=' + product_id + '&warehouse_id=' + warehouse_id + '&qty=' + qty;
    });
});