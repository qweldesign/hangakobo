/**
 * Artwork.js
 * このファイルは QWEL Project の一部です。
 * Part of the QWEL Project © QWEL.DESIGN 2025
 * Licensed under GPL v3 – see https://qwel.design/
 */

/* Default Collection
 * "珊瑚礁",
 * "森に暮らす日 - 山のあなた",
 * "森の中で",
 * "詩人はランプに灯を点すだけ",
 * "私の住むまち",
 * "いずみ",
 * "焚き火"
 */
export default class Artwork {
  constructor() {
    this._elem = document.getElementById('artwork');
    if (!this._elem) return;

    this.fetch();
  }

  async fetch() {
    const res = await fetch('./content/artworks.json');
    const items = await res.json();
    this.setArtwork(items);
  }

  setArtwork(items) {
    const selected = [];
    items.forEach((item) => {
      if (item.showOnFront) selected.push(item);
    });

    const len = selected.length;
    const r = Math.floor(Math.random() * len);
    const img = this._elem.querySelector('img');
    const caption = this._elem.querySelector('figcaption');
    const src = `./content/artworks/${selected[r].name}s.png`;

    img.setAttribute('src', src);
    caption.textContent = selected[r].title;
  }
}
