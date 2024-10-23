const buyButtons = document.querySelectorAll(".buy");
buyButtons.forEach(button => {
    button.addEventListener("click", () => {
        const num = button.closest('.card-body').querySelector('.quantity').value;
        const price = button.closest('.card-body').querySelector('.price').innerText;
        
        const sum_of_price = num * price;
        sessionStorage.setItem('total_price', sum_of_price);
        
    });
});

let sum_price = sessionStorage.getItem("total_price");
if(sum_price){
    document.getElementById("sum").value = sum_price;
}
