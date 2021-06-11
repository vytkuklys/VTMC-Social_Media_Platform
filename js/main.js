const bioInputField = document.querySelector('.js-bio-input');
const bioUpdateBtn = document.querySelector('.js-bio-show');
const bioCancelBtn = document.querySelector('.js-bio-hide');
const coverToggleMenuBtn = document.querySelector('.js-cover-btn');
const coverUploadPhotoBtn = document.querySelector('.js-cover-upload-btn');
const profileUploadPhotoBtn = document.getElementById('profileImg');
const navDropdownBtn = document.querySelector('.js-drop-menu');
const navSelectBtns = document.querySelectorAll('.js-nav-btn');
const popUpNavBtns = document.querySelectorAll('.js-popup-nav-btn');
const popUpOpenBtn = document.querySelector('.js-popup-open-btn');
const popUpExitBtn = document.querySelectorAll('.js-popup-exit-btn');
const postInputField = document.querySelector('.js-post-input');
const postManageBtn = document.querySelectorAll('.js-post-manage-btn');
const postImageBtn = document.querySelector('.js-post-img-btn');
const postCreateBtn = document.querySelectorAll('.js-open-create-post-btn');
const postCancelImgBtn = document.querySelector('.js-post-cancel-img-btn');
const postUpdateBtn = document.querySelectorAll('.js-post-update-btn');
const postDeleteBtn = document.querySelectorAll('.js-post-delete-btn');
const commentToggleBtn = document.querySelectorAll('.js-comment-toggler');
const commentInputFieldBtn = document.querySelectorAll('.js-comment-input'); 

const uploadCoverPhoto = () => {
    const file = coverUploadPhotoBtn.files;
    if (file) {
        const fileReader = new FileReader();

        fileReader.onload = function (event) {
            coverToggleMenuBtn.style.backgroundImage = `url(${event.target.result})`;
            renderValidationForm();
        }
        fileReader.readAsDataURL(file[0]);
    }
    handleAddCover();
}

const uploadProfilePhoto = () => {
    const file = profileUploadPhotoBtn.files;
    if (file) {
        const fileReader = new FileReader();
        const profile = document.querySelector('.js-profle-img');
        fileReader.onload = function (event) {
            profile.style.backgroundImage = `url(${event.target.result})`;
            saveProfilePhoto();
        }
        fileReader.readAsDataURL(file[0]);
    }
}

const saveProfilePhoto = () => {
    const files = profileUploadPhotoBtn.files[0];
    const API_ENDPOINT = "./includes/profileUpdate.inc.php";
    const request = new XMLHttpRequest();
    const formData = new FormData();

    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            
        }
    };
    formData.append("file", files);
    formData.append('submit', true);
    request.send(formData);
}

const isFormRendered = () =>{
    const form = document.querySelector('.c-validation');
    return form == null ? false : true;
}

const renderValidationForm = () => {
    if(isFormRendered()){
        const form = document.querySelector('.c-validation');
        form.classList.remove('h-hide');
        return;
    }

    const body = document.body;
    const form = document.createElement('div');
    const warning = document.createElement('p');
    const cancelBtn = document.createElement('button');
    const saveBtn = document.createElement('button');

    form.classList.add('c-validation');
    warning.classList.add('c-validation__warning')
    cancelBtn.classList.add('c-btn', 'c-validation__cancel-btn');
    saveBtn.classList.add('c-btn', 'c-validation__save-btn');

    warning.textContent = 'Your cover photo is public';
    cancelBtn.textContent = 'Atšaukti';
    saveBtn.textContent = 'Išsaugoti pakeitimus';

    form.appendChild(warning);
    form.appendChild(cancelBtn);
    form.appendChild(saveBtn);

    body.appendChild(form);

    addClickEvents(saveBtn, cancelBtn);
}

const addClickEvents = (saveBtn, cancelBtn) => {
    cancelBtn.addEventListener('click', handleCloseValidation);
    saveBtn.addEventListener('click', handleSaveCoverImage);
}

const handleSaveCoverImage = () => {
    const files = coverUploadPhotoBtn.files[0];
    const API_ENDPOINT = "./includes/coverUpdate.inc.php";
    const request = new XMLHttpRequest();
    const formData = new FormData();

    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            handleCloseValidation();
        }
    };
    formData.append("file", files);
    formData.append('submit', true);
    request.send(formData);
}

const handleCloseValidation = () => {
    const form = document.querySelector('.c-validation');
    form.classList.add('h-hide');

    const bgImage = document.querySelector("[data-bg]").getAttribute("data-bg");
    coverToggleMenuBtn.style.backgroundImage = `url(./uploads/${bgImage})`;
}

const handleBioInput = digitCount => {
    const bioRemainingDigits = document.querySelector('.js-digits-quota');
    const quota = 101 - digitCount;
    enableBioSubmit();
    if (quota < 0) {
        return;
    }
    bioRemainingDigits.textContent = quota;
}

const handleCommentInput = (event) =>{
    const submitBtn = event.target.nextElementSibling;
    const value = event.target.value.length;
    submitBtn.classList.add('h-comment-submit-btn');
    if(value == 0){
        submitBtn.classList.remove('h-comment-submit-btn');
    }
}

const isEmpty = digitCount => {
    return !digitCount;
}

const enablePostCreateSubmit = (digitCount) => {
    const postSubmitBtn = document.querySelector('.js-post-submit');
    if (isEmpty(digitCount)){
        postSubmitBtn.classList.remove('h-submit-btn')   
        return;
    }
    if (!postSubmitBtn.classList.contains('h-submit-btn')) {
        postSubmitBtn.classList.add('h-submit-btn');
    }
}

const showFileName = () => {
    const file = postImageBtn.files;
    const imgContainer = document.querySelector('.js-file-info');
    const img = document.querySelector('.js-popup-img');
    
    if (file) {
        const fileReader = new FileReader();
        enablePostCreateSubmit(1);

        fileReader.onload = function (event) {
            img.setAttribute('src', event.target.result);
            imgContainer.classList.remove('h-hide');
        }
        fileReader.readAsDataURL(file[0]);
    }
}

const enableBioSubmit = () => {
    const bioSubmitBtn = document.querySelector('.js-bio-submit');
    if (!bioSubmitBtn.classList.contains('h-submit-btn')) {
        bioSubmitBtn.classList.add('h-submit-btn');
    }
}

const disableBioSubmit = () => {
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

const handleClosePopUp = e => {
    e.preventDefault();
    const popup = document.querySelectorAll('.c-pop-up__form');
    popup.forEach(form => {
        form.classList.add('h-hide');
    })
}

const handleOpenCreatePostPopup = () => {
    const popup = document.querySelector('.c-pop-up__create-post');
    popup.classList.remove('h-hide');
}

const handleOpenUpdatePostPopup = (text, img, id) => {
    const popup = document.querySelector('.c-pop-up__create-post');
    const title = document.querySelector('.js-post-title');
    const imgContainer = document.querySelector('.js-file-info')
    const image = document.querySelector('.js-popup-img');
    const form = document.querySelector('.js-popup-form');
    const postSubmitBtn = document.querySelector('.js-post-submit');

    postSubmitBtn.setAttribute('value', id);
    title.textContent = "Redaguoti įrašą";
    postInputField.setAttribute('rows', 2);
    postInputField.textContent = text;
    form.setAttribute('action', './includes/postUpdate.inc.php');
    imgContainer.classList.remove('h-hide');
    image.setAttribute('src', img)
    popup.classList.remove('h-hide');

    togglePostManager(id);
}

const handleOpenDeletePostPopup = id =>{
    const submitBtn = document.querySelector('.js-delete-submit-btn');
    const popup = document.querySelector('.js-delete-popup');
    const title = document.querySelector('.js-delete-title');
    const info = document.querySelector('.js-delete-info');
    const form = document.querySelector('.js-delete-form');

    title.textContent = 'Ištrinti pranešimą?';
    info.textContent = 'Ar tikrai norite ištrinti šį pranešimą?';
    form.setAttribute('action', './includes/postDelete.inc.php');

    popup.classList.remove('h-hide');
    submitBtn.setAttribute('value', id);

    togglePostManager(id);
}

const handleCommentsMenuToggle = id =>{
    const menu = document.querySelector(`[data-id="${id}"]`).parentElement;
    if(menu.classList.contains('h-hide')){
        loadComments(event);
    }
    menu.classList.toggle('h-hide');
}

function loadComments(event){
    var id = event.target.parentElement.children[1].id
    $(`[data-id=${id}]`).load("./includes/commentLoad.inc.php",{
        postId: id
    }, function(responseText, textStatus, XMLHttpRequest) {
        if (textStatus == "success") {
            addCommentManagerEvents();
            addCommentDeleteEvents();
            addCommentUpdateEvents();
        }
       if (textStatus == "error") {
       }
    });
}

const handleOpenPopUp = () => {
    const popup = document.querySelector('.c-pop-up__form');
    handleAddCover();
    popup.classList.remove('h-hide');
}

const togglePostManager = id => {
    if (!id) return;
    const popup = document.getElementById(id);
    popup.classList.toggle('h-hide');
}

const toggleCommentManager = id => {
    if (!id) return;
    const popup = document.getElementById(id);
    popup.classList.toggle('h-hide');
}

const openCommentDeleteForm = id =>{
    const submitBtn = document.querySelector('.js-delete-submit-btn');
    const popup = document.querySelector('.js-delete-popup');
    const title = document.querySelector('.js-delete-title');
    const info = document.querySelector('.js-delete-info');
    const form = document.querySelector('.js-delete-form');

    title.textContent = 'Ištrinti komentarą?';
    info.textContent = 'Ar tikrai norite ištrinti šį komentarą?';
    form.setAttribute('action', './includes/commentDelete.inc.php');

    popup.classList.remove('h-hide');
    submitBtn.setAttribute('value', id);

    togglePostManager(id);
}

const openCommentUpdateForm = id =>{
    const form = document.querySelector('.js-comment-update-popup');
    const text = document.querySelector(`[data-text='${id}']`).textContent;
    const textField = document.querySelector('.js-comment-update-field');
    const submitBtn = document.querySelector('.js-update-submit-btn');

    textField.textContent = text;
    submitBtn.setAttribute('value', id);
    console.log(text)
    form.classList.remove('h-hide');
    
    togglePostManager(id);
}

function test(form){
    form.focus();
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

const handleCancelImagePost = e => {
    e.preventDefault();
    const image = document.getElementById('postImg');
    const imageInfo = document.querySelector('.js-file-info');
    image.value = null;
    imageInfo.classList.add('h-hide');
}

bioInputField.addEventListener('keyup', () => {
    const digitCount = bioInputField.value.length;
    handleBioInput(digitCount);
});

postInputField.addEventListener('keyup', () => {
    const digitCount = postInputField.value.length;
    console.log(digitCount);
    enablePostCreateSubmit(digitCount);
});

commentInputFieldBtn.forEach(field =>{
    field.addEventListener('keyup', (event) => {
        handleCommentInput(event);
    });
});

bioUpdateBtn.addEventListener('click', handleShowBioUpdate);

bioCancelBtn.addEventListener('click', (e) => handleCloseBioUpdate(e));

popUpExitBtn.forEach(btn => {
    btn.addEventListener('click', (e) => handleClosePopUp(e));
});

popUpOpenBtn.addEventListener('click', (e) => handleOpenPopUp(e));

navDropdownBtn.addEventListener('click', (e) => handleDropMenu());

postManageBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.parentElement.parentElement.children[1].id;
        togglePostManager(id);
    });
});
//functional expressions to add event listeners on dynamically created content 
const addCommentManagerEvents = ()=> {
    const manageBtn = document.querySelectorAll('.js-comment-menu-btn');
    manageBtn.forEach(btn => {
        if(needsEventListener(btn)){
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.nextElementSibling.id;
                toggleCommentManager(id);
            });
        }
    });
}

const addCommentDeleteEvents = ()=> {
    const deleteBtn = document.querySelectorAll('.js-comment-delete-btn');
    deleteBtn.forEach(btn => {
        if(needsEventListener(btn)){
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.parentElement.id;
                openCommentDeleteForm(id);
            });
        }
    });
}

const addCommentUpdateEvents = ()=> {
    const updateBtn = document.querySelectorAll('.js-comment-update-btn');
    updateBtn.forEach(btn => {
        if(needsEventListener(btn)){
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.parentElement.id;
                console.log('hi');
                openCommentUpdateForm(id);
            });
        }
    });
}

const needsEventListener = (btn) => {
    return btn.getAttribute('data-event-click') == 'is set' ? false : true;
}

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

postImageBtn.addEventListener('change', showFileName);

coverUploadPhotoBtn.addEventListener('change', uploadCoverPhoto);

profileUploadPhotoBtn.addEventListener('change', uploadProfilePhoto);

postCancelImgBtn.addEventListener('click', (e) => handleCancelImagePost(e));

postCreateBtn.forEach(btn => {
    btn.addEventListener('click', handleOpenCreatePostPopup)
});

postUpdateBtn.forEach(btn => {
    btn.addEventListener('click', ()=>{
        const message = btn.parentElement.parentElement.children[2].textContent;
        const id = btn.parentElement.id;
        const img = btn.parentElement.parentElement.children[3].getAttribute('src');
        handleOpenUpdatePostPopup(message, img, id);
    });
});

postDeleteBtn.forEach(btn => {
    btn.addEventListener('click', ()=>{
        const id = btn.parentElement.id;
        handleOpenDeletePostPopup(id);
    });
});

commentToggleBtn.forEach(btn => {
    btn.addEventListener('click', ()=>{
        const id = btn.parentElement.children[1].id;
        handleCommentsMenuToggle(id);
    });
});

coverToggleMenuBtn.addEventListener('click', (e) => {
    if (e.target.classList.contains('js-cover-btn') || e.target.classList.contains('c-hero__cover-btn')) {
        handleAddCover();
    }
});
