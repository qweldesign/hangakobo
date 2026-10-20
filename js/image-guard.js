/**
 * Image Guard
 * © 2026 QWEL.DESIGN (https://qwel.design)
 * Released under the MIT License.
 * See LICENSE file for details.
 */

/**
 * 画像を簡単には保存できないようにする (body[data-protect-images] のページだけで動く)
 * - 右クリックのメニューを出さない
 * - 画像・canvas のドラッグ (デスクトップやほかのタブへのドロップ) をさせない
 * - 画像の長押しメニュー (iOS) と選択は CSS (_imageGuard.scss) で止める
 * ※ スクリーンショットや開発者ツールまでは防げないので, 著作権表示と合わせて使う
 */
export default class ImageGuard {
  constructor(elem) {
    this.elem = elem || document.querySelector('[data-protect-images]');
    if (!this.elem) return;

    // 右クリックのメニュー (フォームの入力欄だけは, 貼り付けなどに使えるように残す)
    this.elem.addEventListener('contextmenu', (event) => {
      if (event.target.closest('input, textarea, select')) return;
      event.preventDefault();
    });

    // 画像・canvas のドラッグ
    this.elem.addEventListener('dragstart', (event) => {
      if (event.target.closest('img, canvas, picture, svg, figure')) {
        event.preventDefault();
      }
    });

    // 画像に draggable="false" を付ける (dragstart を止められないブラウザ向けの念押し)
    this.elem.querySelectorAll('img').forEach((img) => img.setAttribute('draggable', 'false'));
  }
}
