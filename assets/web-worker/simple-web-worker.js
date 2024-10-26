const first = document.querySelector('#number1');
const second = document.querySelector('#number2');

const result = document.querySelector('.result');

if (window.Worker) {
    const myWorker = new Worker("http://localhost/loketech_market_analysis/assets/web-worker/simple-worker.js");

    first.onchange = function() {
        myWorker.postMessage([first.value, second.value]);
        // console.log('Message posted to worker first');
        console.log('Pesan diposting ke pekerja pertama');
    }

    second.onchange = function() {
        myWorker.postMessage([first.value, second.value]);
        // console.log('Message posted to worker second');
        console.log('Pesan diposting ke pekerja kedua');
    }

    myWorker.onmessage = function(e) {
        result.textContent = e.data;
        // console.log('Message received from worker');
        console.log('Pesan diterima dari pekerja');
    }
} else {
    console.log('Your browser doesn\'t support web workers.');
}