document.addEventListener("DOMContentLoaded",function() {
    let productSearchInput = document.getElementById("product_search");
    let warehouseDropdown = document.getElementById("warehouse_id");
    let product_list = document.getElementById("product_list");
    let warehouseError = document.getElementById("warehouse_error");
    let orderItemsTableBody = document.querySelector("tbody");


    productSearchInput.addEventListener("keyup", function(){
        let query = this.value;
        let warehouse_id = warehouseDropdown.value;

        if(!warehouse_id){
            warehouseError.classList.remove('d-none');
            product_list.innerHTML = "";
            return;
        } else{
            warehouseError.classList.add('d-none');
        }
        if(query.length > 1) {
            fetchProducts(query, warehouse_id);
        } else {
            product_list.innerHTML = "";
        }
    });

    function fetchProducts(query, warehouse_id){
        fetch(productSearchInput + "?query=" + query + "&warehouse_id=" + warehouse_id)
        .then(response => response.json())
        .then(data=> {
            product_list.innerHTML = "";
            if(data.length > 0 ){
                data.forEach(product => {
                    let item = ` <a href="#" class="list-group-item list-group-item-action product-item"
                     data-id="${product.id}"
                     data-code="${product.code}"
                     data-name="${product.name}"
                     data-cost="${product.price}"
                     data-stock="${product.product_qty}">
                     <i class="fas fa-search me-2"></i>
                     ${ product.code } - ${product.name}
                     </a> `;
                     product_list.innerHTML += item;
                });
            }
        });
    }

});
