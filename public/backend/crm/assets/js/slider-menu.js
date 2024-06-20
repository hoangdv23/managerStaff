const menu_one = document.querySelector("#menu-1");
const menu_two = document.querySelector("#menu-2");
const call_time = document.querySelector("#call_time");
const btn_call = document.querySelector("#btn_call");
const icon_call_header = document.querySelector("#icon-call-header");
const btn_digit = document.querySelectorAll(".digit-called");
const output = document.querySelector("#output-called");
const btn_delete = document.querySelector("#btn_delete");
let isCalling = false;
let countdownInterval;
let durationInSeconds = 0;
// set intial calling
// call_time.innerHTML = "00:00:00";
const next_slide_menu = () =>{
  menu_one.classList.add("d-none");
  menu_two.classList.remove("d-none");
}

const prev_slide_menu = () => {
  menu_two.classList.add("d-none");
  menu_one.classList.remove("d-none");
}

const startCall = () => {
  if (!isCalling) {
    isCalling = true;
    btn_call.title = "Ngắt kết nối";
    icon_call_header.classList.remove("bi-telephone-fill", "text-success");
    icon_call_header.classList.add("bi-telephone-x-fill", "text-danger");
    let remainingTime = durationInSeconds;
    updateCountdownDisplay(remainingTime);

    countdownInterval = setInterval(() => {
      remainingTime++;
      updateCountdownDisplay(remainingTime);

      if (remainingTime <= 0) {
        clearInterval(countdownInterval);
      }
    }, 1000);
  } else {
    isCalling = false;
    stopCountdown();
    btn_call.title = "Gọi điện";
    icon_call_header.classList.add("bi-telephone-fill", "text-success");
    icon_call_header.classList.remove("bi-telephone-x-fill", "text-danger");
  }
};

function stopCountdown() {
  clearInterval(countdownInterval);
  call_time.textContent = "00:00:00";
}

function updateCountdownDisplay(timeInSeconds) {
  const hours = Math.floor(timeInSeconds / 3600);
  const minutes = Math.floor((timeInSeconds % 3600) / 60);
  const seconds = timeInSeconds % 60;
  call_time.textContent = `${
    hours === 0 ? "00" : `${hours < 10 ? "0" + hours : hours}`
  }:${minutes === 0 ? `00` : minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
}
btn_digit.forEach((_digit) => {
  _digit.addEventListener("click", (e) => {
    btn_delete.classList.remove("d-none");
    const old_value = output.value;
    const value = _digit.textContent;
    output.value = old_value + value;
  });
});
const onChangeInputNumber = (e) => {
  if (value.length === 0) {
    btn_delete.classList.add("d-none");
  } else {
    btn_delete.classList.remove("d-none");
  }
};
const deleteNumber = () => {
  let value = output.value;
  if (value.length === 1) {
    btn_delete.classList.add("d-none");
  }

  value = value.slice(0, -1);
  output.value = value;
};
