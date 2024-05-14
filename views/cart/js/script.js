// document.getElementById('fechaExpiracion').addEventListener('input', function (event) {
//     let value = event.target.value.replace(/\D/g, ''); // Eliminar caracteres que no sean dígitos
//     value = value.slice(0, 4); // Limitar la longitud a 4 caracteres
//     value = value.replace(/^(\d{2})(\d{2})/, '$1/$2'); // Formato MM/AA
//     event.target.value = value;
// });
//
// document.getElementById('tarjeta').addEventListener('input', function (event) {
//     let value = event.target.value.replace(/\s+/g, ''); // Eliminar espacios en blanco
//     value = value.replace(/\D/g, ''); // Eliminar caracteres que no sean dígitos
//
//     // Limitar a 16 dígitos
//     value = value.slice(0, 16);
//
//     // Agregar espacios cada 4 dígitos
//     value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
//
//     event.target.value = value;
// });
//
// document.getElementById('cvv').addEventListener('input', function (event) {
//     let value = event.target.value.replace(/\D/g, ''); // Eliminar caracteres que no sean dígitos
//     value = value.slice(0, 4); // Limitar la longitud a 4 dígitos
//     event.target.value = value;
// });