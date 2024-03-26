const pvcButtons = document.querySelectorAll('.pvc-button');
const arrowUpButtons = document.querySelectorAll('.arrow-up');
const arrowDownButtons = document.querySelectorAll('.arrow-down');

pvcButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    const pvcLists = document.querySelectorAll('.pvc-list');
    pvcLists.forEach((list) => {
      list.style.display = 'none';
    });
    pvcLists[index].style.display = 'block';
  });
});

arrowUpButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const listId = button.getAttribute('data-list-id');
      const itemId = button.getAttribute('data-id');
      const list = document.getElementById(listId);
      const items = Array.from(list.querySelectorAll('.pvc-item'));
      const currentItemIndex = items.findIndex((item) => item.id === itemId);
  
      if (currentItemIndex > 0) {
        const previousItem = items[currentItemIndex - 1];
        list.insertBefore(document.getElementById(itemId), previousItem);
      }
    });
  });

arrowDownButtons.forEach((button) => {
  button.addEventListener('click', () => {
    const listId = button.getAttribute('data-list-id');
    const itemId = button.getAttribute('data-id');
    const list = document.getElementById(listId);
    const items = Array.from(list.querySelectorAll('.pvc-item'));
    const currentItemIndex = items.findIndex((item) => item.id === itemId);

    if (currentItemIndex < items.length - 1) {
      const nextItem = items[currentItemIndex + 1];
      list.insertBefore(nextItem, document.getElementById(itemId));
    }
  });
});
