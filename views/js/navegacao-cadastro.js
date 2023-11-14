function nextPart() {
    document.getElementById('formPart1').classList.remove('visible');
    document.getElementById('formPart2').classList.add('visible');
    document.getElementById('return').classList.remove('invisible');
    document.getElementById('cadastrar').classList.remove('invisible');
}

function returnPart() {
    document.getElementById('formPart2').classList.remove('visible');
    document.getElementById('formPart1').classList.add('visible');
    document.getElementById('return').classList.add('invisible');
    document.getElementById('cadastrar').classList.add('invisible');
}