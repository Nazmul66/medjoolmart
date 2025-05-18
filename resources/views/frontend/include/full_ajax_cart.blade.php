<script>
     
    $(document).ready(function () {
        var currencySymbol = "{{ getSetting()->currency_symbol }}"; 
        var currencyName = "{{ getSetting()->currency_name }}"; 

       //__ Quick View Cart __//
       $(document).on('click', '.quickview', function (e) {
           e.preventDefault(); // Prevent default behavior if necessary
           var id = $(this).data('id'); // Use `data-id` attribute

           $.ajax({
               type: "GET",
               url: "{{ route('cart.quick.view') }}",
               data: { id: id }, // Pass `id` as a key-value pair
               success: function (res) {
                   // console.log(res); // Handle response
                   var product = res.product;

                   $('#modal_qty').val(1);
                   $('#product_id').val(`${product.id}`);
                   $('#thumb_image').html(res.main_image);
                   $('#category_name').text(`${product.cat_name}`);
                   $('#product_name').text(`${product.name}`);
                   $('.prdt_qty').text(`${product.qty}`);
                   $('.product_units').text(`${product.units}`);
                   $('#sold_product').text(`${product.product_sold}`);
                   $('.tf-product-info-price').html(res.price_val);
                   $('#short_desc').text(`${product.short_description}`);
                   $('#product_view').text(`${product.product_view}`);
                   // $('.total_price').text('$' + res.product_price);
                   $('.main_color_variant').removeClass('d-none');
                   $('.main_size_variant').removeClass('d-none');

                   var imagesHtml = '';

                   // Loop through the images array
                   res.multi_images.forEach(function (image) {
                       imagesHtml += `
                           <div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
                               <img class="lazyload" data-src="${image}" src="${image}" alt="">
                           </div>
                       `;
                   });
                   $('.multiple_image').html(imagesHtml);

                   if (res.product_color && res.product_color.length > 0) {
                        var colorsHtml = '';

                       // Loop through the product_color array
                       res.product_color.forEach(function (color, index) {
                           colorsHtml += `
                               <div class="">
                                   <input id="color${color.id}" type="radio" data-price="${color.color_price}" name="color_id" value="${color.id}" ${index === 0 ? 'checked' : ''}>
                                   <label class="hover-tooltip tooltip-bot radius-60 color-btn  color_show ${index === 0 ? 'active' : ''}" 
                                       data-slide="0" 
                                       data-price="${color.color_price || ''}" 
                                       for="color${color.id}" 
                                       data-value="${color.color_name}" 
                                       data-scroll-quickview="${color.color_name.toLowerCase()}"
                                       >
                                       <span class="btn-checkbox" style="background-color:${color.color_code || ''}"></span>
                                       <span class="tooltip">${color.color_name} ( ${currencyName} ${color.color_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       $('#color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                   } else {
                       $('#color_variant').html('');
                        //    $('.text-title.color_variant').text('No Color');
                        $('.main_color_variant').addClass('d-none');
                   }


                   if (res.product_sizes && res.product_sizes.length > 0) {
                       var sizesHtml = '';

                       // Loop through the product_sizes array
                       res.product_sizes.forEach(function (size, index) {
                           sizesHtml += `
                               <div class="">
                                   <input type="radio" name="size_id" data-price="${size.size_price}" id="size${size.id}" value="${size.id}" ${index === 0 ? 'checked' : ''}>
                                   <label class="hover-tooltip tooltip-bot style-text size-btn for="size${size.id}" data-value="${size.size_name.toUpperCase()}" data-size-price="${size.size_price}" >
                                       <span class="text-title">${size.size_name.toUpperCase()}</span>
                                       <span class="tooltip">${size.size_name} ( ${currencyName} ${size.size_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       // Update the size container
                       $('#size_variant').html(sizesHtml);

                       // Dynamically set the first size name in the text-title span
                       var firstSize = res.product_sizes[0]; // Get the first size
                       $('.text-title.size_variant').text(firstSize.size_name.toUpperCase());
                   } else {
                       $('#size_variant').html('');
                        //    $('.text-title.size_variant').text('No Size');
                        $('.main_size_variant').addClass('d-none');
                   }
               },
               error: function (err) {
                   console.log(err);
               }
           });
       });

       //__ Quick Add Cart __//
       $(document).on('click', '.quickAdd', function (e) {
           e.preventDefault(); // Prevent default behavior if necessary
           var id = $(this).data('id'); // Use `data-id` attribute

           $.ajax({
               type: "GET",
               url: "{{ route('cart.quick.view') }}",
               data: { id: id }, // Pass `id` as a key-value pair
               success: function (res) {
                   // console.log(res); // Handle response
                   var product = res.product;

                   $('#quick_add_qty').val(1);
                   $('#quick_product_id').val(`${product.id}`);
                   $('.prdt_qty').text(`${product.qty}`);
                   $('#quick_thumb_image').html(res.main_image);
                   $('#quick_product_name').text(`${product.name}`);
                   $('.product_units').text(`${product.units}`);
                   $('.tf-product-info-price').html(res.price_val);
                   $('.main_color_variant').removeClass('d-none');
                   $('.main_size_variant').removeClass('d-none');
                   
                   if (res.product_color && res.product_color.length > 0) {
                        var colorsHtml = '';

                       // Loop through the product_color array
                       res.product_color.forEach(function (color, index) {
                           colorsHtml += `
                            <div class="mb-2">
                                <input id="color${color.id}" type="radio" data-price="${color.color_price}" name="color_id" value="${color.id}" ${index === 0 ? 'checked' : ''}>
                                <label class="hover-tooltip tooltip-bot radius-60 color-btn  color_show ${index === 0 ? 'active' : ''}" 
                                    data-slide="0" 
                                    data-price="${color.color_price || ''}" 
                                    for="color${color.id}" 
                                    data-value="${color.color_name}" 
                                    data-scroll-quickview="${color.color_name.toLowerCase()}"
                                    >
                                    <span class="btn-checkbox" style="background-color:${color.color_code || ''}"></span>
                                    <span class="tooltip">${color.color_name} ( ${currencyName} ${color.color_price} )</span>
                                </label>
                            </div>`;
                       });

                       $('#quick_color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                   } else {
                       $('#quick_color_variant').html('');
                       $('.main_color_variant').addClass('d-none');
                   }


                   if (res.product_sizes && res.product_sizes.length > 0) {
                       var sizesHtml = '';

                       // Loop through the product_sizes array
                       res.product_sizes.forEach(function (size, index) {
                           sizesHtml += `
                            <div class="mb-2">
                                <input type="radio" name="size_id" data-price="${size.size_price}" id="size${size.id}" value="${size.id}" ${index === 0 ? 'checked' : ''}>
                                <label class="hover-tooltip tooltip-bot style-text size-btn for="size${size.id}" data-value="${size.size_name.toUpperCase()}" data-size-price="${size.size_price}" >
                                    <span class="text-title">${size.size_name.toUpperCase()}</span>
                                    <span class="tooltip">${size.size_name} ( ${currencyName} ${size.size_price} )</span>
                                </label>
                            </div>`;
                       });

                       // Update the size container
                       $('#quick_size_variant').html(sizesHtml);

                       // Dynamically set the first size name in the text-title span
                       var firstSize = res.product_sizes[0]; // Get the first size
                       $('.text-title.size_variant').text(firstSize.size_name.toUpperCase());
                   } else {
                        $('.main_size_variant').addClass('d-none');
                        $('#quick_size_variant').html('');
                   }
               },
               error: function (err) {
                   console.log(err);
               }
           });
       });

       // For color select
       $(document).on('click', '.color_show', function () {
           var radioId = $(this).attr('for');
           var $radioInput = $('#' + radioId);

           if ($radioInput.length) {
               $radioInput.prop('checked', true);

               var colorName = $(this).attr('data-value');
               $('.color_variant').text(colorName);

               $('.color_show').removeClass('active');
               $(this).addClass('active');
           }
       });

       // For size select
       $(document).on('click', '.size-btn', function () {
           var radioInput = $(this).prev('input[type="radio"]');
           radioInput.prop('checked', true);

           var selectedSize = $(this).data('value');
           $('.size_variant').text(selectedSize);

           $('.size-btn').removeClass('active');
           $(this).addClass('active');
       });

       // Product add to cart
       $('.add-to-cart-form').on('submit', function(e) {
           e.preventDefault(); 

           // Get the value of the clicked button
           const clickedButton = $('button[type="submit"]:focus');
           const buttonValue = clickedButton.val(); // 'add_cart' or 'buy_now'
           let formData = $(this).serialize() + '&button_value=' + buttonValue;
           $.ajax({
               method: 'POST',
               data: formData,
               url: "{{ route('add.cart') }}",
               success: function(data) {
                   // Handle success
                   if( data.status === 'success' ){
                       // console.log('Product added to cart:', data);
                       sidebarCartData();
                       sidebarCartActionElement();
                       getSidebarCartTotal();
                       getCartCount();
                       toastr.success(data.message);

                       if( data.button_value === "buy_now" ){
                           $('.show-shopping-cart').removeClass('show-shopping-cart');
                           window.location.href = "{{ url('/checkout') }}";
                       }
                       else{
                           // Add the 'show-shopping-cart' class to the clicked button
                           clickedButton.addClass('show-shopping-cart');
                           // Show the modal
                           $('#shoppingCart').modal('show');
                       }
                   }
                   else if( data.status === 'error' ){
                       toastr.error(data.message);
                   }
               },
               error: function(data) {
                   // Handle error
                   // console.log('Error adding product to cart:', data);
                   toastr.error('Failed to add product to cart.');
               },
           });
       });

       // Fetch all sidebar cart data
       function sidebarCartData(){
           $.ajax({
               method: 'GET',
               url: "{{ route('get.sidebar.cart') }}",
               success: function(response) {
                   if (response.status === true) {
                       let cartHtml = '';
                       response.cartItems.forEach(item => {
                           cartHtml += `
                               <div class="tf-mini-cart-item file_delete" id="side_remove-${item.rowId}">
                                   <div class="tf-mini-cart-image">
                                       <img class="lazyload" data-src="${item.image}" src="${item.image}" alt="${item.slug}">
                                   </div>
                                   <div class="tf-mini-cart-info flex-grow-1">
                                       <div class="mb_12 d-flex align-items-center justify-content-between de-flex gap-12">
                                           <div class="text-title">
                                               <a href="/product-details/${item.slug}" class="link text-line-clamp-1">${item.name}</a>
                                           </div>
                                           <div class="text-button tf-btn-remove remove side_remove_cart" data-row_id="${item.rowId}">Remove</div>
                                       </div>
                                       <div class="d-flex align-items-center justify-content-between de-flex gap-12">
                                           <div class="text-secondary-2">
                                               ${item.size_name ? item.size_name.toUpperCase() + ` (${currencySymbol}${item.size_price})` : ''} 
                                               ${item.color_name ? ` / ${item.color_name} (${currencySymbol}${item.color_price})` : ''}
                                           </div>
                                           <div class="text-button">${item.qty} ${item.units} X ${currencySymbol}${item.price}</div>
                                       </div>
                                       <div class="d-flex align-items-center justify-content-between de-flex gap-12">
                                           <div class="text-secondary-2">Amount</div>
                                           <div class="text-button">${currencySymbol}${item.total}</div>
                                       </div>
                                   </div>
                               </div>
                           `;
                       });

                       // Update the cart sidebar body
                       $('#cart-sidebar-table-body').html(cartHtml);
                       sidebarCartActionElement();
                   }
               },
               error: function(err) {
                   toastr.error('Failed to fetch cart data.');
                   console.log(err);
               }
           });
       }

       //__ Sidebar Single product clear __//
       $(document).on('click', '.side_remove_cart', function(e) {
           e.preventDefault();
           let id = $(this).data('row_id');    
           // console.log(id); 

           $.ajax({
               url: "{{ url('/cart/remove-product') }}/" + id,
               method: 'GET',
               dataType: 'json',
               data: { id: id },
               success: function(data) {
                   // console.log(data);
                   if( data.status === 'success' ){ 
                       getSidebarCartTotal();
                       let singleProductRemove = '#side_remove-' +id;
                       $(singleProductRemove).remove();

                       // Check if the table is empty and display the message
                       const tableBody = $('#cart-sidebar-table-body'); // Replace with the actual tbody ID or class
                       if (tableBody.children('.tf-mini-cart-item').length === 0) {
                           tableBody.html(`
                               <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                   <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                               </div>
                           `);
                           $('.tf-mini-cart-threshold').remove();
                           $('#tf-mini-cart-actions-field').remove();
                       }
                       getCartCount(); 
                       toastr.success(data.message);
                   }
               },
               error: function(err) {
                   console.log(err);
               },
           })
       })

       //__ Cart Count __//
       function getCartCount(){
           $.ajax({
               method: 'GET',
               url: "{{ route('cart.count') }}",
               success: function(data) {
                   console.log(data);
                   if( data.status === 'success' ){
                      $('.count-box').text(data.cartCount);
                   }
               },
               error: function(data) {
                   // console.log('Error adding product to cart:', data);
               },
           });
       }

       //__ Cart subTotal __//
       function getSidebarCartTotal(){
           $.ajax({
               method: 'GET',
               url: "{{ route('cart.sidebar-product-total') }}",
               success: function(data) {
                   console.log('get total', data);
                   if( data.status === 'success' ){
                      $('.tf-totals-total-value').text(`${currencySymbol}` + data.total);
                   }
               },
               error: function(data) {
                   console.log('Error adding product to cart:', data);
               },
           });
       }

       //__ Sidebar Cart Element __//
       function sidebarCartActionElement(){
           $('.mini-cart-actions').html(`
               <div id="tf-mini-cart-actions-field">

                   <div class="tf-mini-cart-view-checkout">
                       <a href="{{ route('show-cart') }}" class="tf-btn w-100 btn-white radius-4 has-border"><span class="text">View cart</span></a>
                       <a href="{{ route('checkout') }}" class="tf-btn w-100 btn-fill radius-4"><span class="text">Check Out</span></a>
                   </div>

                   <div class="text-center">
                       <a class="link text-btn-uppercase" href="{{ route('product.page') }}">Or continue shopping</a>
                   </div>    
               </div>
           `);
       }

       $('.quick_view_cart').on('click', function() {
           $('.show-shopping-cart').removeClass('show-shopping-cart');
       });

        // Subscription Form
        $('#newsletter_form').on('submit', function (e) {
            e.preventDefault();
            let data = $(this).serialize(); // Serialize form data

            $.ajax({
                method: 'POST',
                url: "{{ route('newsletter.request') }}",
                data: data, // Send form data, including the CSRF token
                beforeSend: function(){
                    $('#subscription_btn').html("<i class='bx bx-loader-alt'></i>");
                    $('#subscription_btn').addClass('spinners');
                },
                success: function (data) {
                    if (data.status === 'success') {
                        toastr.success(data.message);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                        $('.subscribe_input').val('')
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                        $('.subscribe_input').val('');
                    }
                },
                error: function (data) {
                    console.log(data);
                    let errors = data.responseJSON?.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                    });
                }
            });
        });

        // Wishlist Add 
        $('.wishlist').on('click', function(e){
            e.preventDefault();
            let button = $(this); // Target the specific button clicked
            let productId = button.data('id');
            let cardProduct = button.closest('.wishlist_product');
            let wishlistContainer = $('.wishlist-product-data'); 
            console.log(productId);

            $.ajax({
                method: 'GET',
                url: "{{ route('wishlist.store') }}",
                data: { id: productId },
                success: function (response) {
                    if (response.status === 'added') {
                        toastr.success(response.message);
                        // button.addClass('active');
                        $('.wishlist[data-id="' + productId + '"]').addClass('active');
                        getWishlistCount();
                    } else if (response.status === 'removed') {
                        toastr.info(response.message);
                        $('.wishlist[data-id="' + productId + '"]').removeClass('active');

                        // Remove the specific wishlist product
                        cardProduct.fadeOut(300, function() {
                            $(this).remove();

                            // If wishlist is empty, show the message
                            if (response.wishlist_count === 0) {
                                wishlistContainer.html(`
                                <div class="tf-grid-layout md-col-12 xl-col-12">
                                    <div class="alert alert-danger text-center" style="margin: 0 24px;" role="alert">
                                        <p class="mb-3">There is no wishlist product available</p>
                                        <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                    </div>
                                </div>
                                `);
                            }
                        });
                        getWishlistCount();
                    } else if (response.status === 'error') {
                        window.location.href = '{{ url("/login") }}'
                    }
                },
                error: function (data) {
                    console.log(data);
                    let errors = data.responseJSON?.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            });
        });

        //__ Wishlist Count __//
        function getWishlistCount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('wishlist.count') }}",
                success: function(data) {
                    console.log(data);
                    if( data.status === 'success' ){
                        $('.wishlist_box').text(data.wishlistCount);
                    }
                },
                error: function(data) {
                    // console.log('Error adding product to cart:', data);
                },
            });
        }
   });

</script>