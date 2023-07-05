function toggleContent(contentId) {
  // Función que muestra u oculta el contenido identificado por contentId
  var content = document.getElementById(contentId);

  if (content.style.display === 'none') {
    content.style.display = 'block';
  } else {
    content.style.display = 'none';
  }
}

const contornoProductos = document.querySelectorAll('.contornoProductos');

contornoProductos.forEach(card => {
  // Maneja los eventos de ratón en cada tarjeta de producto
  card.addEventListener('mouseover', () => {
    card.style.transform = 'scale(0.9)';
  });

  card.addEventListener('mouseout', () => {
    card.style.transform = 'scale(1)';
  });
});
