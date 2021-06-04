const bioInputField = document.querySelector('.js-bio-input');
const bioUpdateBtn = document.querySelector('.js-bio-show');
const bioCancelBtn = document.querySelector('.js-bio-hide');
const bioSubmitBtn = document.querySelector('.js-bio-submit');
const coverToggleMenuBtn = document.querySelector('.js-cover-btn');
const navDropdownBtn = document.querySelector('.js-drop-menu');
const navSelectBtns = document.querySelectorAll('.js-nav-btn');
const popUpNavBtns = document.querySelectorAll('.js-popup-nav-btn');
const popUpOpenBtn = document.querySelector('.js-popup-open-btn');
const popUpExitBtn = document.querySelector('.js-popup-exit-btn');

const handleBioInput = digitCount => {
    const bioRemainingDigits = document.querySelector('.js-digits-quota');
    const quota = 101 - digitCount;
    if (!bioSubmitBtn.classList.contains('h-hero__bio-submit')) {
        bioSubmitBtn.classList.add('h-hero__bio-submit');
    }
    if (quota < 0) {
        return;
    }
    bioRemainingDigits.textContent = quota;
}

const handleShowBioUpdate = () => {
    const form = document.querySelector('.js-bio-form');
    form.setAttribute('aria-hidden', 'false');
    bioUpdateBtn.setAttribute('aria-hidden', 'true');
    form.classList.remove('h-hide');
    bioUpdateBtn.classList.remove('h-show');
}

const handleCloseBioUpdate = (e) => {
    e.preventDefault();
    const form = document.querySelector('.js-bio-form');
    if (bioSubmitBtn.classList.contains('h-hero__bio-submit')) {
        bioSubmitBtn.classList.remove('h-hero__bio-submit');
    }
    bioInputField.value = '';
    form.classList.add('h-hide');
    bioUpdateBtn.classList.add('h-show');
    handleBioInput(0);
}

const handleClosePopUp = () => {
    const popup = document.querySelector('.c-pop-up__form');
    popup.classList.add('h-hide');
}

const handleOpenPopUp = () => {
    const popup = document.querySelector('.c-pop-up__form');
    handleAddCover();
    popup.classList.remove('h-hide');
}

const handleDropMenu = () => {
    const dropMenu = document.querySelector('.c-nav__drop-items');
    dropMenu.classList.toggle('h-hide');
}

const handleAddCover = () => {
    const popUp = document.querySelector('.c-hero__cover-popup');
    popUp.classList.toggle('h-hide');
}

const isBtnSelected = id => {
    return document.getElementById(id).classList.contains('h-selected');
}

const unselectBtn = () => {
    popUpNavBtns.forEach(btn => {
        btn.classList.remove('h-selected');
    })
}

const handlePopUpNav = id => {
    if (isBtnSelected(id)) return;
    const btn = document.getElementById(id);
    unselectBtn();
    btn.classList.add('h-selected');
}

const unselectNavBtn = () => {
    navSelectBtns.forEach(btn => {
        btn.classList.remove('h-selected');
    })
}

const handleSelectNavBtn = id => {
    if (isBtnSelected(id)) return;
    const btn = document.getElementById(id);
    unselectNavBtn();
    btn.classList.add('h-selected');
}

bioInputField.addEventListener('keyup', () => {
    const digitCount = bioInputField.value.length;
    handleBioInput(digitCount);
});

bioUpdateBtn.addEventListener('click', handleShowBioUpdate);

bioCancelBtn.addEventListener('click', (e) => handleCloseBioUpdate(e));



popUpExitBtn.addEventListener('click', (e) => handleClosePopUp(e));

popUpOpenBtn.addEventListener('click', (e) => handleOpenPopUp(e));

navDropdownBtn.addEventListener('click', (e) => handleDropMenu());

popUpNavBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        handlePopUpNav(btn.id);
    });
});

navSelectBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        handleSelectNavBtn(btn.id);
    });
});

coverToggleMenuBtn.addEventListener('click', (e) => {
    if (e.target.classList.contains('js-cover-btn') || e.target.classList.contains('c-hero__cover-btn')) {
        handleAddCover();
    }
});