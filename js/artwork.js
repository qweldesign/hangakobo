/**
 * Artwork.js
 * © 2026 QWEL.DESIGN (https://qwel.design)
 * Released under the MIT License.
 * See LICENSE file for details.
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
    this.elem = document.getElementById('artwork');
    if (!this.elem) return;

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
    const img = this.elem.querySelector('img');
    const caption = this.elem.querySelector('figcaption');
    const src = `./content/artworks/${selected[r].name}s.png`;

    img.setAttribute('src', src);
    caption.textContent = selected[r].title;
  }
}
