 $(document).ready(function () {

     $('.add-product-btn').on('click' , function (e) {
        e.preventDefault();
         var  name=$(this).data('name');
         // alert(name) //get name in alert
         var  id=$(this).data('id');
         var  price=$(this).data('sale');


         $(this).removeClass('btn-success').addClass('btn-default').prop('disabled', true); /// when you add product the btn disaled to preivent add twice

         var html= `<tr>
                <td>${name}</td>
                <input type="hidden" name="products[]" data-price="${id}" class="form-control input-sm product-quantity" min="1" value="1">
                <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price">${price}</td>               
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;
         $('.order-list').append(html);

         $('body').on('click' , '.disabled' , function (e) {
             e.preventDefault();
         })

         $('body').on('click' , '.remove-product-btn' , function (e) {
             e.preventDefault();
             var  id=$(this).data('id');
             $(this).closest('tr').remove(); //to reomcve row
             $('#product-'+id).removeClass('btn-default').prop('disabled' , false).addClass('btn-success');
         });


     });


                    $('body').on('keyup change' , '.product-quantity' , function ()
                    {
                        var  quntity=parseInt($(this).val());
                        var  price=$(this).data('price');
                        // var productPrice=parseInt($(this).closest('tr').find('.product-price').html());
                        $(this).closest('tr').find('.product-price').html(quntity*price);
                        calcTotal();

                    });




 });


var  price=0;
function calcTotal() {
    $('.order-list .product-price').each(function (index) { //each ->itetare each row
price+=parseInt($(this).html());

if (price > 0 )
{
    $('add-order-form-btn').removeClass('disabled')
}
else
    {
        $('add-order-form-btn').add('disabled')

    }

$('.total-price').html(price)
    });
}