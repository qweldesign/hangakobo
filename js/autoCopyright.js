/**
 * Auto Copyright
 * このファイルは QWEL Project の一部です。
 * Part of the QWEL Project © QWEL.DESIGN 2025
 * Licensed under GPL v3 – see https://qwel.design/
 */

export default class AutoCopyright {
  constructor(startYear, companyName, elem) {
    elem ||= document.querySelector('.footer__copyright');
    if (elem) elem.innerHTML = this.generate(startYear, companyName);
  }

  generate(startYear, companyName) {
    const currentYear = new Date().getFullYear();
    const text = ' All rights reserved.<br><p><span>警告:</span> 当サイトに掲載の全ての画像・文章・デザイン・レイアウトは著作権法により保護されています。著作権者の許諾を得ずに複製、転載、加工、頒布、販売することを禁じます。違反した場合、民事・刑事上の責任を追及します。使用許可は事前に書面で取得してください。<br><span>Warning:</span> All images, text, designs, and layouts on this website are protected under copyright law. Any reproduction, redistribution, modification, distribution, or sale without the copyright holder’s permission is strictly prohibited. In the event of a violation, civil and criminal liability will be pursued. Written permission must be obtained in advance for any use.</p>';

    if (startYear == currentYear) {
      return `&copy; ${startYear} ${companyName}${text}`
    } else {
      return `&copy; ${startYear} - ${currentYear} ${companyName}${text}`;
    }
  }
}
