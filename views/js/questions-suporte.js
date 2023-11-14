function toggleAnswer(element) {
    const answer = element.nextElementSibling;
    answer.classList.toggle('show');
    const arrowIcon = element.querySelector('.arrow-icon');
    arrowIcon.classList.toggle('rotate');
}
