const inputBio = document.querySelector('.js-bio-input');
const updateBio = document.querySelector('.js-bio-show');
const cancelBio = document.querySelector('.js-bio-hide');

const handleBioInput = digitCount => {
    const bioRemainingDigits = document.querySelector('.js-digits-quota');
    const quota = 101 - digitCount;

    if (quota < 0) {
        return;
    }
    bioRemainingDigits.textContent = quota;
}

const handleShowBioUpdate = () =>{
    const form = document.querySelector('.js-bio-form');
    form.setAttribute('aria-hidden', 'false');
    updateBio.setAttribute('aria-hidden', 'true');
    form.classList.remove('h-bio-hide');
    updateBio.classList.remove('h-bio-show');
}

const handleCloseBioUpdate = (e) =>{
    e.preventDefault();
    const form = document.querySelector('.js-bio-form');
    form.classList.add('h-bio-hide');
    updateBio.classList.add('h-bio-show');
}

inputBio.addEventListener('keyup', () => {
    const digitCount = inputBio.value.length;
    handleBioInput(digitCount);
});

updateBio.addEventListener('click', handleShowBioUpdate);

cancelBio.addEventListener('click', (e) => handleCloseBioUpdate(e));