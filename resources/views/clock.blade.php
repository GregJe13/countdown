@extends('layout.main')
@section('body')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8 flex flex-col items-center">
            <h3 class="font-normal text-2xl text-center">Current Time</h3>
            <div id="clock" class="font-normal text-6xl text-center">00:00:00</div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const display = document.getElementById('clock');//mengambil elemen div clock
    let currentTime = new Date();//dapatkan waktu saat ini lalu masukan ke currentTime
    let hrs = currentTime.getHours();//dapatkan nilai jamnya dengan fungsi .getHours()
    let mnt = currentTime.getMinutes();//dapatkan nilai menitnya dengan fungsi .getMinutes()
    let sec = currentTime.getSeconds();//dapatkan nilai detiknya dengan fungsi .getSeconds()
    //langsung diupdate agar ketika di refresh tidak menampilkan isi div asli yang 00:00:00
    display.textContent = `${String(hrs).padStart(2, '0')}:${String(mnt).padStart(2, '0')}:${String(sec).padStart(2, '0')}`//ubah isi dari display menjadi format ini, variable waktu diubah ke string, lalu pasikan string 2 digit, apabila tidak tambahkan 0 didepan

    setInterval(() => {//buat interval yang update setiap 1 detik
        currentTime = new Date();//dapatkan waktu saat ini lalu masukan ke currentTime
        hrs = currentTime.getHours();//dapatkan nilai jamnya dengan fungsi .getHours()
        mnt = currentTime.getMinutes();//dapatkan nilai menitnya dengan fungsi .getMinutes()
        sec = currentTime.getSeconds();//dapatkan nilai detiknya dengan fungsi .getSeconds()
        display.textContent = `${String(hrs).padStart(2, '0')}:${String(mnt).padStart(2, '0')}:${String(sec).padStart(2, '0')}`//ubah isi dari display menjadi format ini, variable waktu diubah ke string, lalu pasikan string 2 digit, apabila tidak tambahkan 0 didepan
    }, 1000);

    
</script>
@endsection


