onmessage = function(e) {
    // console.log('Worker: Message received from main script ');
    console.log('===========================');
    console.log('Pekerja: Pesan diterima dari skrip utama');
    const result = e.data[0] * e.data[1];
    console.log('Worker message : ', e.data);
    console.log('result : ', result);

    if (isNaN(result)) {
        // postMessage('Please write two numbers');
        postMessage('Tolong tulis dua angka');
    } else {
        const workerResult = 'Result: ' + result;
        // console.log('Worker: Posting message back to main script');
        console.log('Pekerja: Mengeposkan pesan kembali ke skrip utama');
        console.log('workerResult : ', workerResult);
        console.log('===========================');
        postMessage(workerResult);
    }
}