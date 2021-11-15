// Функция closeModalWindow() закрывает (убирает из ДОМ-а) модальное окно
function closeModalWindow() {
  let modalWindow = document.querySelector('.gallery__modal-window')
  modalWindow.remove()
}

/* 
  Функция getModalWindow(imageSrc) возвращает HTML-код для модального окна.
  В качестве аргумента принимает адрес к определенному изображению
*/
function getModalWindow(imageSrc) {
  return `<div class="gallery__modal-window">
            <img src=${imageSrc} class="gallery__modal-window-img">
            <button class="gallery__modal-window-close" onclick="closeModalWindow()">Закрыть</button>
          </div>`
}

let gallery = document.querySelector('.gallery')
let body = document.querySelector('body')
gallery.addEventListener('click', (e) => {
  if (e.target.classList.contains('gallery__image')) {
    // Создаю (вставляю в ДОМ) модальное окно с изображением, на которое нажал пользователь
    body.insertAdjacentHTML('beforeend', getModalWindow(e.target.src))
  }
})