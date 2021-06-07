const bioInputField = document.querySelector('.js-bio-input');
const bioUpdateBtn = document.querySelector('.js-bio-show');
const bioCancelBtn = document.querySelector('.js-bio-hide');
const coverToggleMenuBtn = document.querySelector('.js-cover-btn');
const navDropdownBtn = document.querySelector('.js-drop-menu');
const navSelectBtns = document.querySelectorAll('.js-nav-btn');
const popUpNavBtns = document.querySelectorAll('.js-popup-nav-btn');
const popUpOpenBtn = document.querySelector('.js-popup-open-btn');
const popUpExitBtn = document.querySelectorAll('.js-popup-exit-btn');
const postManageBtn = document.querySelectorAll('.js-post-manage-btn');
const postCreateInputField = document.querySelector('.js-post-create-input');

const handleBioInput = digitCount => {
    const bioRemainingDigits = document.querySelector('.js-digits-quota');
    const quota = 101 - digitCount;
    enableBioSubmit();
    if (quota < 0) {
        return;
    }
    bioRemainingDigits.textContent = quota;
}

const isEmpty = digitCount =>{
    return !digitCount;
}

const enablePostCreateSubmit = (digitCount) =>{
    if(isEmpty(digitCount)) return;
    
    const postSubmitBtn = document.querySelector('.js-post-submit');
    if (!postSubmitBtn.classList.contains('h-submit-btn')) {
        postSubmitBtn.classList.add('h-submit-btn');
    }
}

const enableBioSubmit = () =>{
    const bioSubmitBtn = document.querySelector('.js-bio-submit');
    if (!bioSubmitBtn.classList.contains('h-submit-btn')) {
        bioSubmitBtn.classList.add('h-submit-btn');
    }
}

const disableBioSubmit = () =>{
    const bioSubmitBtn = document.querySelector('.js-bio-submit');
    if (bioSubmitBtn.classList.contains('h-submit-btn')) {
        bioSubmitBtn.classList.remove('h-submit-btn');
    }
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
    bioInputField.value = '';
    form.classList.add('h-hide');
    bioUpdateBtn.classList.add('h-show');
    handleBioInput(0);
    disableBioSubmit();
}

const handleClosePopUp = () => {
    const popup = document.querySelectorAll('.c-pop-up__form');
    popup.forEach(form =>{
        form.classList.add('h-hide');
    })
}

const handleOpenPopUp = () => {
    const popup = document.querySelector('.c-pop-up__form');
    handleAddCover();
    popup.classList.remove('h-hide');
}

const handleTogglePostManager = id => {
    if(!id) return;
    const popup = document.getElementById(id);
    popup.classList.toggle('h-hide');
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

postCreateInputField.addEventListener('keyup', () => {
    const digitCount = postCreateInputField.value.length;
    enablePostCreateSubmit(digitCount);   
});

bioUpdateBtn.addEventListener('click', handleShowBioUpdate);

bioCancelBtn.addEventListener('click', (e) => handleCloseBioUpdate(e));

popUpExitBtn.forEach(btn =>{
    btn.addEventListener('click', (e) => handleClosePopUp(e));
});

popUpOpenBtn.addEventListener('click', (e) => handleOpenPopUp(e));

navDropdownBtn.addEventListener('click', (e) => handleDropMenu());

postManageBtn.forEach(btn =>{
    btn.addEventListener('click', () => {
        const id = btn.parentElement.parentElement.children[1].id;
        handleTogglePostManager(id);
    });
})

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