var arr = new Array;

function main() {
    let input = document.getElementById("input").value;
    let fib_arr = gen_fib(input);
    create_tbl();
}

function gen_fib(input) {
    let n1 = 0, n2 = 1, nextTerm;
    for (let i = 1; i <= input; i++) {
        arr.push(n1);
        nextTerm = n1 + n2;
        n1 = n2;
        n2 = nextTerm;
    }
    return arr;
}

function create_tbl() {
    let div = document.getElementById("fib_div")
    let tbl = document.createElement("TABLE");
    div.appendChild(tbl);
    for (i = 0; i < arr.length; i++) {
        let row1 = tbl.insertRow();
        let td1_1 = row1.insertCell();
        let td1_2 = row1.insertCell();
        td1_1.innerText = i + 1;
        td1_2.innerText = arr[i];
    }
    console.log(tbl)
}