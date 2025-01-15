@extends('layout.main')
@section('body')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8 flex flex-col items-center">
                <input type="number" id="seconds" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Enter seconds" required />
                <div id="time" class="font-normal text-6xl text-center">00:00:00</div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-fit">
                    <div class="flex justify-center"><button type="button" id="start" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Start</button></div>
                    <div class="flex justify-center"><button type="button" id="pause" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">Pause</button></div>
                    <div class="flex justify-center"><button type="button" id="stop" class="focus:outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Stop</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let countdown;//variable untuk menyimpan interval
        let isPaused = false;//boolean untuk cek apakah terpause atau tidak
        let remainingTime;//variabel untuk menyimpan sisa waktu nya

        function startTimer(){
            const second = parseInt(document.getElementById('seconds').value);//masukan nilai inputan second ke dalam variabel second. diubah dari string ke int
            if(isNaN(second) || second<=0){//cek jika input bukan sebuah angka atau <0
                alert("Please enter a valid number!");//kirim alert
                return;
            }
            remainingTime = second;//masukan inputan ke remainingTime
            const endTime = Date.now() + remainingTime * 1000;//kita ambil waktu sekarang, ini formatnya dalam milidetik, lalu kita tambahkan dengan sisa waktu yang dikonfersikan juga ke milidetik untuk mendapatkan endTime nya
            displayTime(remainingTime);//jalankan fungsi displayTime

            countdown = setInterval(() => {//kita buat interval dengan update setiap 1000 milidetik
                if(isPaused) return;//jika terpause, return

                const secondsLeft = Math.round((endTime - Date.now()) / 1000);//cari brp sisa waktu dalam detik dengan mengurangi endTime nya dengan waktu saat ini. kita bagi seribu untuk konversi ke detik

                if(secondsLeft < 0){//jika sudah sampai dibawah 0
                    clearInterval(countdown);//stop interval
                    return;
                }

                remainingTime = secondsLeft;//perbarui nilai remainingTime nya dengan sisa detik saat ini
                displayTime(secondsLeft);//jalankan fungsi displayTime
            }, 1000);

        }

        function displayTime(seconds){
            const hours = Math.floor(seconds/3600);//menghitung jam dari detik dengan dibagi 3600
            const minutes = Math.floor((seconds % 3600) / 60);//menghitung menit dari sisa bagi menghitung jam nya, lalu dibagi 60
            const remainderSeconds = seconds % 60;//menghitung sisa detik setelah menghitung menit dengan %60 yang akan menghasilkan angka antara 0-59

            const display = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(remainderSeconds).padStart(2, '0')}`//membuat format penulisannya, fungsi padStart digunakan untuk memastikan string itu 2 digit, apabila satu tambahkan 0 didepannya

            document.getElementById('time').textContent = display;//update nilai time di html
        }

        document.getElementById('start').addEventListener('click', ()=> {//jika button start diklik
            clearInterval(countdown);//reset interval
            isPaused = false;//tidak terpause
            startTimer();//start
        });
        document.getElementById('pause').addEventListener('click', ()=> {//jika button pause diklik
            isPaused = true;//ubah boolean ke true
            
            
        });
        document.getElementById('stop').addEventListener('click', ()=> {//jika button stop diklik
            clearInterval(countdown);//reset interval
            document.getElementById('time').value = '';//hapus nilai div saat ini
            displayTime(0);//ubah ke 00:00:00 dengan function displayTime
        });
    </script>
@endsection


