@extends('layout.main')
@section('body')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8 flex flex-col items-center">
            <h3 class="font-normal text-2xl text-center">Stopwatch</h3>
            <div id="time" class="font-normal text-6xl text-center">00:00:00:00</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-fit">
                <div class="flex justify-center"><button type="button" id="start" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Start</button></div>
                <div class="flex justify-center"><button type="button" id="pause" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">Reset</button></div>
                <div class="flex justify-center"><button type="button" id="stop" class="focus:outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Stop</button></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const display = document.getElementById('time');//menyimpan elemen div time kedalam variable display
        let timer = null;//variable untuk menyimpan interval
        let startTime = 0;//varialbe untuk menyimpan waktu awal ketika stopwatch dijalankan
        let elapsedTime = 0;//variable untuk menyimpan total waktu yang telah berjalan setelah stopwatch dimulai
        let isRunning = false;//boolean apakah stopwatch sedang berjalan atau tidak

        function update(){
            const currentTime = Date.now();//mengambil waktu saat ini, masukan kedalam variable 
            elapsedTime = currentTime - startTime;//mendapatkan waktu yang telah berlalu semenjak stopwatch mulai, dengan mengurangi waktu saat ini dengan waktu pada saat mulai menjalankan stopwatch

            let hours = Math.floor(elapsedTime / (1000 * 3600));//dapatkan nilai jam nya dengan bagi 3600 lalu konversi ke milidetik dengan *1000 karena format Date.now() itu dalam milidetik
            let minutes = Math.floor(elapsedTime / (1000 * 60) % 60);//dapatkan nilai menit dengan mengubahnya dari milidetik ke menit, lalu kita % dengan 60
            let seconds = Math.floor(elapsedTime / 1000 % 60);//dapatkan nilai detik dengan mengubah milidetik ke detik lalu ambil sisa detik dengan %60
            let miliseconds = Math.floor(elapsedTime % 1000 / 10);//dapatkan milidetik dengan % sisa detiknya, lalu dibagi 10 untuk mendapatkan nilai centiseconds


            display.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}:${String(miliseconds).padStart(2, '0')}`//ubah isi display dengan format ini, ubah variable ke String, lalu pastikan string tersebut 2 digit, apabila tidak, tambahkan 0 didepan
        }

        function startTimer(){
            if(!isRunning){//apabila tidak sedang berjalan
                startTime = Date.now() - elapsedTime;//nilai startTime disesuaikan dengan waktu saat ini dikurangi waktu yang telah berjalan di stopwatch agar bisa pause
                timer = setInterval(update, 10);//start interval dengan isi function update, dengan update setiap 10 milidetik
                isRunning = true;//ubah boolean running menjadi true
            }

        }

        function stop(){
            if(isRunning){//jika sedang berjalan
                clearInterval(timer);//reset interval
                elapsedTime = Date.now() - startTime;//memperbarui elapsedTime dengan waktu saat ini
                isRunning = false;//ubah boolean running menjadi false
            }
        }

        function reset(){
            clearInterval(timer);//berhentikan interval
            startTime = 0;//set nilai awal
            elapsedTime = 0;
            isRunning = false;
            display.textContent = "00:00:00:00"
        }


        document.getElementById('start').addEventListener('click', ()=> {//jika button start diklik
            startTimer();//jalankan function nya
        });
        document.getElementById('pause').addEventListener('click', ()=> {//jika button pause diklik
            reset();//jalankan function nya
        });
        document.getElementById('stop').addEventListener('click', ()=> {//jika button stop diklik
            stop();//jalankan function nya
        });
    </script>
@endsection


