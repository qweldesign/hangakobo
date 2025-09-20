/**
 * Clock.js
 * このファイルは QWEL Project の一部です。
 * Part of the QWEL Project © QWEL.DESIGN 2025
 * Licensed under GPL v3 – see https://qwel.design/
 */

export default class Clock {
  constructor(elem) {
    this.elem = elem || document.getElementById('clock');
    if (!this.elem) return;
    
    this.base = document.getElementById('clockBase');
    this.main = document.getElementById('clockMain');
    this.balloon = document.getElementById('clockBalloon');

    this.setBalloon();
    this.handleEvents();
    this.windowResizeHandler();

    setInterval(() => this.tick(), 1000);
  }

  tick() {
    const now = new Date();
    this.drawClock(now);
    this.changeTimeText(now);
  }


  drawClock(time) {
    const ctx =  this.main.getContext('2d');
    ctx.save();
    ctx.clearRect(0, 0, 240, 240);
    const hour = time.getHours() % 12;
    const min = time.getMinutes();
    const sec = time.getSeconds();
    const radH = (Math.PI * 2) / 12 * (hour + min / 60);
    const radM = (Math.PI * 2) / 60 * min;
    const radS = (Math.PI * 2) / 60 * sec;
    this.drawHand(radH, 36, 8, '#444');
    this.drawHand(radM, 48, 4, '#444');
    this.drawHand(radS, 50, 2, '#f2e4af');
    const centralGradient = ctx.createLinearGradient(117, 117, 123, 123);
    centralGradient.addColorStop(0, '#ed9');
    centralGradient.addColorStop(0.4, '#fdfaf0');
    centralGradient.addColorStop(0.6, '#fdfaf0');
    centralGradient.addColorStop(1.0, '#ed9');
    ctx.fillStyle = '#444';
    ctx.beginPath();
    ctx.arc(120, 120, 8, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.fillStyle = centralGradient;
    ctx.beginPath();
    ctx.arc(120, 120, 6, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.restore();
  }


  drawHand(rotation, length, width, color) {
    const ctx =  this.main.getContext('2d');
    ctx.save();
    ctx.lineWidth = width;
    ctx.strokeStyle = color;
    ctx.shadowColor = 'rgba(0, 0, 0, .3)';
    ctx.shadowOffsetX = 4;
    ctx.shadowOffsetY = 2;
    ctx.shadowBlur = 4;
    ctx.translate(120, 120);
    ctx.rotate(rotation);
    ctx.beginPath();
    ctx.moveTo(0, 0);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.restore();
  }


  changeTimeText(time) {
    let meridian = time.getHours > 12;
    meridian = meridian != null ? '午後' : '午前';
    const hour = time.getHours() % 12;
    const min = time.getMinutes();
    const sec = time.getSeconds();
    const timeText = `${meridian}${hour}時${min}分${sec}秒`;
    this.balloonText.textContent = timeText;
  }


  setBalloon() {
    this.balloonImage = document.createElement('canvas');
    this.balloonImage.id = 'balloonImage';
    this.balloonImage.width = 240;
    this.balloonImage.height = 240;
    this.balloon.appendChild(this.balloonImage);
    this.balloonText = document.createElement('p');
    this.balloonText.id = 'currentTime';
    this.balloon.appendChild(this.balloonText);
    this.drawBalloon();
  }


  drawBalloon() {
    const ctx = this.balloonImage.getContext('2d');
    ctx.clearRect(0, 0, 240, 240);
    ctx.fillStyle = '#fff';
    ctx.save();
    ctx.translate(120, 234);
    ctx.rotate(-Math.PI / 180 * 30);
    ctx.scale(0.5, 1);
    ctx.beginPath();
    ctx.arc(0, -60, 60, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.restore();
    ctx.save();
    ctx.globalCompositeOperation = 'destination-out';
    ctx.translate(120, 234);
    ctx.scale(0.5, 1);
    ctx.beginPath();
    ctx.arc(0, -60, 60, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.restore();
    ctx.save();
    ctx.scale(4, 3);
    ctx.beginPath();
    ctx.arc(30, 30, 30, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.restore();
  }


  handleEvents() {
    window.addEventListener('resize', () => {
      this.windowResizeHandler();
    });
  }


  windowResizeHandler() {
    const clockWidth = this.base.clientWidth / 2;
    console.log()
    this.main.style.width = `${clockWidth}px`;
    this.main.style.height = `${clockWidth}px`;
    this.balloonImage.style.width = `${this.balloon.clientWidth}px`;
    this.balloonImage.style.height = `${this.balloon.clientHeight}px`;
  }
}
