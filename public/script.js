const buyButtons = document.querySelectorAll(".buy"); // পরিবর্তন: buy একটি সিঙ্গল এলিমেন্ট ছিল, এখন সব buy এলিমেন্ট নিচ্ছে।
buyButtons.forEach(button => {
    button.addEventListener("click", () => {
        const num = button.closest('.card-body').querySelector('.quantity').value; // এইভাবে প্রাসঙ্গিক quantity ফিল্ডটি পাচ্ছি
        const price = button.closest('.card-body').querySelector('.price').innerText; // এইভাবে প্রাসঙ্গিক price ফিল্ডটি পাচ্ছি
        
        const sum_of_price = num * price;
        console.log(sum_of_price);
        
        // লোকাল স্টোরেজে ডেটা সংরক্ষণ
        localStorage.setItem('total_price', sum_of_price);
        
        // sum এর ইনপুট ফিল্ডে মান সেট করা
        // document.getElementById('sum').value = sum_of_price; // এখানে sum_of_price ইনপুট ফিল্ডে সেট করা হচ্ছে
    });
});


const form = document.querySelector('form');
form.addEventListener('submit', function(event) {
    event.preventDefault(); // ফর্মের ডিফল্ট সাবমিশন বন্ধ করুন

    const sum = document.getElementById('sum').value;

    // AJAX কল করুন
    fetch('/process-payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF টোকেন
        },
        body: JSON.stringify({ amount: sum })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            form.submit(); // ফর্মটি সাবমিট করুন
        } else {
            alert('Payment failed! Please try again.'); // পেমেন্ট ব্যর্থ হলে বার্তা দেখান
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});



// ticket page
// document.getElementById('pay').addEventListener('click', function (e) {
//     e.preventDefault();
    
//     let ticketNumber = document.getElementById('ticketNumber').value;
//     let name = document.getElementById('name').value;
//     let phone = document.getElementById('phone').value;
    
//     fetch('/pay-via-bkash', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             ticketNumber: ticketNumber,
//             name: name,
//             phone: phone
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.message === 'Payment Successful') {
//             document.getElementById('progressText').innerText = data.progress + '% Complete';
//             document.getElementById('progressBar').style.width = data.progress + '%';

//             if (data.progress === 100) {
//                 document.getElementById('pay').disabled = true; // বাটন ডিজেবল
//             }
//         } else {
//             alert(data.message);
//         }
//     })
//     .catch(error => console.log('Error:', error));
// });



// document.getElementById('paymentForm').addEventListener('submit', function(event) {
//     event.preventDefault(); // ফর্ম সাবমিট আটকানোর জন্য

//     const name = document.getElementById('name').value;
//     const phone = document.getElementById('phone').value;
//     const ticketNumber = document.getElementById('ticketNumber').value;

//     // AJAX কল দিয়ে ডেটা পাঠানো
//     fetch('/bkash/payment', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             name: name,
//             phone: phone,
//             ticketNumber: ticketNumber
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         // পেমেন্ট সফল হলে ডেটা প্রোসেস করার পরবর্তী পদক্ষেপ
//         if (data.success) {
//             // পেমেন্ট সফল হলে কি করবেন, সেই অনুযায়ী কাজ করতে পারেন
//             alert('Payment successful! Data saved.');
//         } else {
//             alert('Payment failed! Please try again.');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });
















// ticket page script
// let totalCollected = 0;
// const ticketPrice = 10;
// const maxAmount = 1000;

// function buyTicket() {
//     let ticketNumber = document.getElementById('ticketNumber').value;
//     let totalPrice = ticketNumber * ticketPrice;
    
//     totalCollected += totalPrice;
//     if (totalCollected > maxAmount) {
//         totalCollected = maxAmount; // max limit of 1000 BDT
//     }
    
//     document.getElementById('totalPrice').innerText = `Total Price: ${totalPrice} BDT`;

//     // Update progress bar
//     let percentage = (totalCollected / maxAmount) * 100;
//     document.getElementById('progressBar').style.width = percentage + '%';
//     document.getElementById('progressText').innerText = `${percentage.toFixed(2)}% Complete`;
// }
