function getDate() {
  var date;
  var f = new Date();
  date = (f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());
  console.log(date);
}

