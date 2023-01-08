let lop1 = "";
let lop2 = "";
let lop3 = "";
let jum = 3;

for (let q = 0; q < jum; q++) {
  lop1 += "* ";
  console.log(lop1);
}

for (let i = 0; i < jum; i++) {
  for (let a = 0; a < jum; a++) {
    lop2 += "* ";
  }
  lop2 += "\n";
}
console.log(lop2);

for (let w = 0; w < jum; w++) {
  for (let e = jum; e > w; e--) {
    lop3 += "* ";
  }
  lop3 += "\n";
}
console.log(lop3);

// for (let i = jum; i > 1; i--) {}

function tambah(a1, a2) {
  let a3 = a1 + a2;
  return a3;
}

console.log(tambah(1, 2));
