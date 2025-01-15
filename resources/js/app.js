import './bootstrap';
let countdown;
let isPaused = false;
let remainingTime;

function startTimer(){
    const minutes = parseInt(document.getElementById('time').value);
    if(isNan(minutes) || minutes<=0){
        alert("Please enter a valid number!");
        return;
    }
    remainingTime = minutes * 60;
    const endTime = Date.now() + remainingTime * 1000;
    displayTime(remainingTime);

    countdown = setInterval(() => {
        if(isPaused) return;

        const secondsLeft = Math.round((endTime - Date.now()) / 1000);

        if(secondsLeft < 0){
            clearInterval(countdown);
            return;
        }

        remainingTime = secondsLeft;
        displayTime(secondsLeft);
    }, 1000);

}

function displayTime(seconds){
    const hours = Math.floor(seconds/3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainderSeconds = seconds % 60;

    const display = `${String(hours).padStart(2, '0')}: ${String(minutes).padStart(2, '0')}: ${String(remainderSeconds).padStart(2, '0')}`

    document.getElementById('time').textContent = display;
}

document.getElementById('start').addEventListener('click', ()=> {
    clearInterval(countdown);
    isPaused = false;
    startTimer();
});
document.getElementById('pause').addEventListener('click', ()=> {
    isPaused = true;
});
document.getElementById('stop').addEventListener('click', ()=> {
    clearInterval(countdown);
    document.getElementById('time').value = '';
    displayTime(0);
});
