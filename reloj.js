function digiClock() {
  var vDate = new Date();
  var vHora = vDate.getHours();
  var vMin = vDate.getMinutes();
  var vSeg = vDate.getSeconds();

  vMin = (vMin < 10 ? "0" : "") + vMin;
  vSeg = (vSeg < 10 ? "0" : "") + vSeg;

  vHora = (vHora < 10 ? "0" : "") + vHora;

  var vHoraSistema = "<h3><p style='font-size: 40px' > " + vHora + " : " + vMin + " : " + vSeg + "</p><h3>";

  var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

  vHoraSistema = vHoraSistema + (diasSemana[vDate.getDay()] + ", " + vDate.getDate() + " de " + meses[vDate.getMonth()]);


  $("#reloj").html(vHoraSistema);
}

$(document).ready(function () {
  setInterval("digiClock()", 1000);
});