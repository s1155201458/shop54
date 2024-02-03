let list = JSON.parse(localStorage.getItem('list')) || [];

document.addEventListener('DOMContentLoaded', () => {
  updatelist();
});

function addToList(name, price) {
  list.push({name, price});
  updatelist();
}

function updatelist() {
  const listcon = document.getElementById('listContainer');
  listContainer.innerHTML = 'Shopping List';

  let total = 0;

  list.forEach(item => {
    const listItem = document.createElement('div');
    listItem.classList.add('list-item');
    listItem.innerHTML = `<p>${item.name} - $${item.price}</p>`;
    listContainer.appendChild(listItem);
    total += item.price;
  });

  const totalElement = document.createElement('div');
  totalElement.classList.add('total');
  totalElement.innerHTML = `<p>Total: $${total.toFixed(2)}</p>`;
  listContainer.appendChild(totalElement);

  const button = document.createElement('button')
  button.className = 'btn btn-success';
  button.innerText = 'Checkout'
  listContainer.appendChild(button);

  localStorage.setItem('list', JSON.stringify(list));
}