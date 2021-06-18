'use strict';
import LocalStorage from './LocalStorage.js';

const search = document.querySelector('.js-search');
const searchBtn = document.querySelector('.js-open-search-btn');
const bioInput = document.querySelector('.js-bio-input');
const bioUpdateBtn = document.querySelector('.js-bio-show');
const bioCancelBtn = document.querySelector('.js-bio-hide');
const bioSubmitBtn = document.querySelector('.js-bio-submit');
const coverToggleMenuBtn = document.querySelector('.js-cover-btn');
const coverUploadPhotoBtn = document.querySelector('.js-cover-upload-btn');
const profileUploadPhotoBtn = document.getElementById('profileImg');
const navDropdownBtn = document.querySelector('.js-drop-menu');
const navSelectBtns = document.querySelectorAll('.js-nav-btn');
const popUpExitBtn = document.querySelectorAll('.js-popup-exit-btn');
const commentToggleBtn = document.querySelectorAll('.js-comment-toggler');
const commentInput = document.querySelectorAll('.js-comment-input');
const commentUpdateBtn = document.querySelector('.js-update-submit-btn');
const commentCreateBtn = document.querySelectorAll('.c-comment__submit-btn');
const commentDeleteBtn = document.querySelectorAll('.js-delete-btn');
const postInput = document.querySelector('.js-post-input');
const postManageBtn = document.querySelectorAll('.js-post-manage-btn');
const postImageBtn = document.querySelector('.js-post-img-btn');
const postCreateBtn = document.querySelectorAll('.js-open-create-post-btn');
const postCancelImgBtn = document.querySelector('.js-post-cancel-img-btn');
const postUpdateBtn = document.querySelectorAll('.js-post-update-btn');
const postDeleteBtn = document.querySelectorAll('.js-post-delete-btn');
const postLikeBtn = document.querySelectorAll('.js-post-like-btn');
const postSubmitBtn = document.querySelector('.js-post-submit');
const autocompleteCloseBtn = document.querySelector('.js-close-autocomplete');


const renderCoverPhoto = (link) => {
    coverToggleMenuBtn.style.backgroundImage = `url(${link})`;
    renderValidationForm();
    handleAddCover();
}

const renderProfilePhoto = (link) => {
    const profile = document.querySelector('.js-profle-img');

    profile.style.backgroundImage = `url(${link})`;
    handleUploadProfilePhoto();
}

const renderPostPhoto = (link, id) => {
    const profile = document.querySelector(`[data-img="${id}"]`);

    profile.setAttribute('src', `${link}`);
}

const renderPhoto = (file, callback, id = 0) => {
    if (file) {
        const fileReader = new FileReader();
        fileReader.onload = function (event) {
            callback(event.target.result, id);
        }
        fileReader.readAsDataURL(file);
    }
}

const uploadPhoto = (file, API_ENDPOINT, callback = () => {}, previousPhotoPath = 0) => {
    const request = new XMLHttpRequest();
    const formData = new FormData();
    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            callback();
        }
    };
    formData.append("previousPhoto", previousPhotoPath);
    formData.append("file", file);
    formData.append('submit', true);
    request.send(formData);
}

const handleUploadProfilePhoto = () => {
    const profileImage = document.querySelector("[data-profile-img]").getAttribute("data-profile-img");
    const file = profileUploadPhotoBtn.files[0];
    const API_ENDPOINT = "./includes/profileUpdate.inc.php";

    if (profileImage) {
        const previousPhotoPath = `.${profileImage}`;
        uploadPhoto(file, API_ENDPOINT, () => {}, previousPhotoPath);
    } else {
        uploadPhoto(file, API_ENDPOINT);
    }
}

const handleUploadCoverPhoto = () => {
    const bgImage = document.querySelector("[data-bg]").getAttribute("data-bg")
    const file = coverUploadPhotoBtn.files[0];
    const API_ENDPOINT = "./includes/coverUpdate.inc.php";

    if (bgImage) {
        const previousPhotoPath = `../uploads/${bgImage}`;
        uploadPhoto(file, API_ENDPOINT, closeValidationForm, previousPhotoPath);
    } else {
        uploadPhoto(file, API_ENDPOINT, closeValidationForm);
    }
}
const isFormRendered = () => {
    const form = document.querySelector('.c-validation');
    return form == null ? false : true;
}

const renderValidationForm = () => {
    if (isFormRendered()) {
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

const handleCancelCoverImage = () => {
    closeValidationForm();

    const bgImage = document.querySelector("[data-bg]").getAttribute("data-bg");
    coverToggleMenuBtn.style.backgroundImage = `url(./uploads/${bgImage})`;
}

const closeValidationForm = () => {
    const form = document.querySelector('.c-validation');
    form.classList.add('h-hide');
}

const addClickEvents = (saveBtn, cancelBtn) => {
    cancelBtn.addEventListener('click', handleCancelCoverImage);
    saveBtn.addEventListener('click', handleUploadCoverPhoto);
}

const handleBioInput = digit => {
    const bioRemainingDigits = document.querySelector('.js-digits-quota');
    const quota = 101 - digit;
    enableBioSubmit();
    if (quota < 0) {
        return;
    } else if (quota == 101) {
        disableBioSubmit();
    }
    bioRemainingDigits.textContent = quota;
}

const handleCommentInput = (event) => {
    const submitBtn = event.target.nextElementSibling;
    const value = event.target.value.length;
    submitBtn.classList.add('h-comment-submit-btn');
    if (value == 0) {
        submitBtn.classList.remove('h-comment-submit-btn');
    }
}

const isEmpty = digit => {
    return !digit;
}

const enablePostCreateSubmit = (digit) => {
    // const postSubmitBtn = document.querySelector('.js-post-submit');
    if (isEmpty(digit)) {
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
    const bio = document.querySelector('.js-bio-text');

    if (bio) {
        bio.classList.add('h-hide');
        bioInput.value = bio.textContent.trim();
        handleBioInput(bio.textContent.trim().length);
    }
    form.setAttribute('aria-hidden', 'false');
    bioUpdateBtn.setAttribute('aria-hidden', 'true');
    form.classList.remove('h-hide');
    bioUpdateBtn.classList.remove('h-show');
}

const handleCloseBioUpdate = (e) => {
    if (e) e.preventDefault();
    const form = document.querySelector('.js-bio-form');
    const bio = document.querySelector('.c-hero__bio-text');

    if (bio) {
        bio.classList.remove('h-hide');
    }
    bioInput.value = '';
    form.classList.add('h-hide');
    bioUpdateBtn.classList.add('h-show');
    handleBioInput(0);
    disableBioSubmit();
}

const renderBio = value => {
    const bio = document.querySelector('.js-bio-text');
    bio.textContent = value;
}

const handleBioSubmit = async () => {
    const value = bioInput.value;
    const API_ENDPOINT = './includes/userBioUpdate.inc.php';
    const id = 0;

    await uploadContent(id, value, API_ENDPOINT, () => {
        renderBio(value)
    });
    handleCloseBioUpdate();
}

const handleClosePopUp = e => {
    if (e) e.preventDefault();
    const popup = document.querySelectorAll('.c-pop-up__form');
    popup.forEach(form => {
        form.classList.add('h-hide');
    })
    removeBlur();
}

const renderCreatePost = () => {
    const popup = document.querySelector('.c-pop-up__create-post');
    const title = document.querySelector('.js-post-title');
    const form = document.querySelector('.js-popup-form');
    // const postSubmitBtn = document.querySelector('.js-post-submit');
    const imgContainer = document.querySelector('.js-file-info')


    postSubmitBtn.textContent = "Sukurti įrašą";
    postInput.setAttribute('rows', 4);
    postInput.value = '';
    title.textContent = "Sukurti įrašą";
    imgContainer.classList.add('h-hide');
    form.setAttribute('action', './includes/postCreate.inc.php')
    popup.classList.remove('h-hide');
    renderBlur();
}

const renderUpdatePost = (text, img, id) => {
    const popup = document.querySelector('.c-pop-up__create-post');
    const title = document.querySelector('.js-post-title');
    const imgContainer = document.querySelector('.js-file-info')
    const image = document.querySelector('.js-popup-img');
    const form = document.querySelector('.js-popup-form');
    // const postSubmitBtn = document.querySelector('.js-post-submit');

    postSubmitBtn.setAttribute('value', id);
    postSubmitBtn.textContent = "Išsaugoti";
    title.textContent = "Redaguoti įrašą";
    postInput.setAttribute('rows', 2);
    postInput.value = text;
    form.setAttribute('action', './includes/postUpdate.inc.php');
    if (img) {
        imgContainer.classList.remove('h-hide');
        image.setAttribute('src', img)
    } else {
        imgContainer.classList.add('h-hide');
    }
    enablePostCreateSubmit(1);
    popup.classList.remove('h-hide');
}

const handleOpenUpdatePostPopup = (text, img, id) => {
    renderUpdatePost(text, img, id);
    togglePostManager(id);
    renderBlur();
}

const handleOpenDeletePostPopup = id => {
    const submitBtn = document.querySelector('.js-delete-btn');
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
    renderBlur();
}

const handleCommentsMenuToggle = id => {
    const menu = document.querySelector(`[data-id="${id}"]`).parentElement;
    if (menu.classList.contains('h-hide')) {
        loadComments(id);
    }
    menu.classList.toggle('h-hide');
}

const handleUserLikedComments = () => {
    const comments = LocalStorage.getLikedComments();
    renderUserLikes(comments);
}

const handleLoadedComments = () => {
    addCommentManagerEvents();
    addCommentDeleteEvents();
    addCommentUpdateEvents();
    addCommentLikeEvents();
    handleUserLikedComments();
}

function loadComments(id) {
    $(`[data-id=${id}]`).load("./includes/commentLoad.inc.php", {
        postId: id
    }, function (responseText, textStatus, XMLHttpRequest) {
        if (textStatus == "success") {
            handleLoadedComments();
        }
        if (textStatus == "error") {}
    });
}

const unlikePost = id => {
    $(document).load("./includes/postUnlike.inc.php", {
        postId: id
    }, function (responseText, textStatus, XMLHttpRequest) {
        if (textStatus == "success") {
            renderPostUnlike(id);
        }
        if (textStatus == "error") {
            console.log('Something went wrong');
        }
    });
}

const isLiked = id => {
    const btn = document.querySelector(`[data-likes="${id}"]`);
    return btn.classList.contains('h-color');
}

const handleLikedPost = id => {
    if (isLiked(id)) {
        unlikePost(id);
        return;
    }
    $(document).load("./includes/postLike.inc.php", {
        postId: id
    }, function (responseText, textStatus, XMLHttpRequest) {
        if (textStatus == "success") {
            renderPostLike(id);
        }
        if (textStatus == "error") {
            console.log('Something went wrong');
        }
    });
}

function renderPostUnlike(id) {
    const container = document.querySelector(`[data-reaction="${id}"]`);
    const like = container.children[0];
    const likeBtn = container.nextElementSibling.children[0];
    const counter = container.children[0].children[1];
    const newLikesNr = parseInt(counter.textContent) - 1;

    likeBtn.classList.remove('h-color');
    if (newLikesNr === 0) {
        like.classList.add('h-hide');
    }
    counter.textContent = newLikesNr;
}

function renderPostLike(id) {
    const container = document.querySelector(`[data-reaction="${id}"]`);
    const like = container.children[0];
    const likeBtn = container.nextElementSibling.children[0];
    const counter = container.children[0].children[1];
    const newLikesNr = parseInt(counter.textContent) + 1;

    likeBtn.classList.add('h-color');
    like.classList.remove('h-hide');
    counter.textContent = newLikesNr;
}

const unlikeComment = id => {
    $(document).load("./includes/commentUnlike.inc.php", {
        commentId: id
    }, function (responseText, textStatus, XMLHttpRequest) {
        if (textStatus == "success") {
            renderCommentUnlike(id);
        }
        if (textStatus == "error") {
            console.log('Something went wrong');
        }
    });
}

function renderCommentUnlike(id) {
    const container = document.querySelector(`[data-comment-likes="${id}"]`);
    const counter = container.children[1];
    const likeBtn = document.querySelector(`[data-likes="${id}"]`);
    const newLikesNr = parseInt(counter.textContent) - 1;

    likeBtn.classList.remove('h-color');
    if (newLikesNr === 0) {
        container.classList.add('h-hide');
    }
    counter.textContent = newLikesNr;
}

function renderCommentLike(id) {
    const container = document.querySelector(`[data-comment-likes="${id}"]`);
    const counter = container.children[1];
    const likeBtn = document.querySelector(`[data-likes="${id}"]`);
    const newLikesNr = parseInt(counter.textContent) + 1;

    likeBtn.classList.add('h-color');
    container.classList.remove('h-hide');
    counter.textContent = newLikesNr;
}

const handleLikedComment = id => {
    if (isLiked(id)) {
        unlikeComment(id);
        return;
    }
    $(document).load("./includes/commentLike.inc.php", {
        commentId: id
    }, function (responseText, textStatus, XMLHttpRequest) {

        if (textStatus == "success") {
            renderCommentLike(id);
        }
        if (textStatus == "error") {
            console.log('Something went wrong');
        }
    });
}

const togglePostManager = id => {
    if (!id) return;
    hidePopupManagers(id);
    const popup = document.getElementById(id);
    popup.classList.toggle('h-hide');
}

const hidePopupManagers = id => {
    const popups = document.querySelectorAll('.c-popup');
    popups.forEach(popup => {
        if (popup.id !== id) {
            popup.classList.add('h-hide');
        }
    })
}

const toggleCommentManager = id => {
    if (!id) return;
    const popup = document.getElementById(id);
    hidePopupManagers(id);
    popup.classList.toggle('h-hide');
}

const openCommentDeleteForm = id => {
    const submitBtn = document.querySelector('.js-delete-btn');
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
    renderBlur();
}

const openCommentUpdateForm = id => {
    const form = document.querySelector('.js-comment-update-popup');
    const text = document.querySelector(`[data-text='${id}']`).textContent;
    const textField = document.querySelector('.js-comment-update-field');
    const submitBtn = document.querySelector('.js-update-submit-btn');

    textField.textContent = text;
    submitBtn.setAttribute('value', id);
    form.classList.remove('h-hide');

    togglePostManager(id);
    renderBlur();
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
    const imageContainer = document.querySelector('.js-file-info');
    image.value = null;
    imageContainer.classList.add('h-hide');
}

const getUniqueSearchItems = items => {
    return items.filter((v, i, a) => a.indexOf(v) === i);
}

const getSearchItems = () => {
    let items = [];
    const posts = document.querySelectorAll('.c-post__text');
    const users = document.querySelectorAll('.c-post__author');
    posts.forEach(post => {
        items.push(post.textContent);
    })
    users.forEach(user => {
        items.push(user.textContent);
    })
    return items;
}

const getMatchingSearchItems = (items, value) => {
    let matchingItems = [];
    let index;
    items = getUniqueSearchItems(items);
    items.forEach(item => {
        index = item.toLowerCase().indexOf(value.toLowerCase());
        if (index !== -1) {
            matchingItems.push({
                name: item,
                index: index
            });
        }
    });
    return matchingItems;
}

const isMatchingStart = index => {
    return index === 0 ? true : false;
}

const isMatchingEnd = (title, index, value) => {
    return index + value === title.length ? true : false;
}

const getLastAutocompleteItem = value => {
    const rightText = document.createElement('span');
    const leftText = document.createElement('span');
    const lastItem = document.createElement('p');
    const icon = document.createElement('span');

    rightText.textContent = "Search for ";
    leftText.textContent = value;
    leftText.classList.add('h-bold');
    icon.classList.add('c-search__icon');
    lastItem.classList.add('c-search__autocomplete-item', 'js-last-item');
    lastItem.append(icon, rightText, leftText);
    return lastItem;
}
const removeAutocompleteItems = () => {
    const container = document.querySelector(".js-autocomplete");
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
}

const renderAutocomleteCloseBtn = () => {
    autocompleteCloseBtn.classList.remove('h-hide');
}

const handleClickSearchItem = item => {
    let value;
    const items = getSearchItems();
    if (item.classList.contains('js-last-item')) {
        value = item.children[2].textContent;
    } else {
        value = item.textContent;
    }
    const matches = getMatchingSearchItems(items, value.split('...')[0]);
    handleSearchResults(matches);
}

const addAutocompleteEvents = () => {
    const items = document.querySelectorAll('.c-search__autocomplete-item');
    items.forEach(item => {
        item.addEventListener('click', () => {
            handleClickSearchItem(item);
        });
    })
}

const renderAutocomplete = (matches, value) => {
    const container = document.querySelector('.js-autocomplete');
    const autocomplete = document.createElement('div');
    const lastItem = getLastAutocompleteItem(value);
    matches.forEach(item => {
        const rightText = document.createElement('span');
        const middleText = document.createElement('span');
        const leftText = document.createElement('span');
        const fullText = document.createElement('p');
        const icon = document.createElement('span');
        if (item.name.length > 30) {
            rightText.textContent = `${item.name.substring(0, 30)}...`
        } else {
            if (isMatchingStart(item.index)) {
                rightText.textContent = item.name.substring(0, value.length);
                rightText.classList.add('h-bold')
                leftText.textContent = item.name.substring(value.length, item.name.length);
            } else if (isMatchingEnd(item.name, item.index, value.length)) {
                rightText.textContent = item.name.substring(0, item.index);
                leftText.textContent = item.name.substring(item.index, item.name.length);
                leftText.classList.add('h-bold')
            } else {
                rightText.textContent = item.name.substring(0, item.index);
                middleText.textContent = item.name.substring(item.index, item.index + value.length);
                middleText.classList.add('h-bold')
                leftText.textContent = item.name.substring(item.index + value.length, item.name.length);
            }
        }
        icon.classList.add('c-search__icon');
        fullText.classList.add('c-search__autocomplete-item');
        fullText.append(icon, rightText, middleText, leftText);
        autocomplete.appendChild(fullText);
    });
    renderAutocomleteCloseBtn();
    autocomplete.classList.add('c-search__autocomplete');
    autocomplete.appendChild(lastItem);
    container.appendChild(autocomplete);
    addAutocompleteEvents();
}

const getCurrentFocus = () => {
    let currentFocus = -1;
    const items = document.querySelectorAll('.c-search__autocomplete-item');
    items.forEach((item, index) => {
        if (item.classList.contains('h-autocomplete-active')) currentFocus = index;
    });
    return currentFocus;
}

const removeAutocompleteActive = () => {
    const active = document.querySelector('.h-autocomplete-active');
    if (active) active.classList.remove('h-autocomplete-active');
}

const addAutocompleteActive = (currentFocus, size) => {
    const items = document.querySelectorAll('.c-search__autocomplete-item')
    removeAutocompleteActive();
    if (currentFocus >= size) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (size - 1);
    if (currentFocus + 1 === size) {
        search.value = items[currentFocus].children[2].textContent;
    } else {
        search.value = items[currentFocus].textContent;
    }
    items[currentFocus].classList.add("h-autocomplete-active");
}

const handleAutocompleteNav = keyCode => {
    const size = document.querySelectorAll('.c-search__autocomplete-item').length;
    let currentFocus = getCurrentFocus();
    if (keyCode == 40) { //arrow down
        currentFocus++;
        addAutocompleteActive(currentFocus, size);
    } else if (keyCode == 38) { //arrow up
        currentFocus--;
        addAutocompleteActive(currentFocus, size);
    }
}

const closeAutocomplete = () => {
    const container = document.querySelector('.js-autocomplete');
    removeAutocompleteItems();
    container.classList.remove('c-search__autocomplete');
    autocompleteCloseBtn.classList.add('h-hide');
    if (window.matchMedia('screen and (max-width: 550px)').matches) {
        const search = document.querySelector('.c-search__input');
        searchBtn.classList.remove('h-hide');
        search.classList.add('h-hide-mobile');
    }
    search.value = '';
}

const handleSearchResults = (matches) => {
    const matching = matches.map(match => match.name);
    const posts = document.querySelectorAll('.c-post__text');
    posts.forEach(post => {
        post.parentElement.classList.add('h-hide');
        const container = document.querySelector(`[data-post="${post.getAttribute('data-msg')}"]`);
        const author = document.querySelector(`[data-author="${post.getAttribute('data-msg')}"]`);
        if (matching.includes(post.textContent) || matching.includes(author.textContent)) {
            post.parentElement.classList.remove('h-hide')
        }
    })
    closeAutocomplete();
}

const handleSearch = (value, keyCode) => {
    if (!value && value !== 0 && keyCode !== 13) return;
    const items = getSearchItems();
    const matches = getMatchingSearchItems(items, value);
    if (keyCode == 40 || keyCode == 38) {
        handleAutocompleteNav(keyCode);
    } else if (keyCode == 13) {
        handleSearchResults(matches);
    } else {
        removeAutocompleteItems();
        renderAutocomplete(matches, value);
    }
}

const openSearchfield = () =>{
    const search = document.querySelector('.c-search__input');
    searchBtn.classList.add('h-hide');

    if(search.classList.contains('h-hide-mobile')){
        search.classList.remove('h-hide-mobile');
    }
    handleSearch('posts', 1);
}

const renderBlur = () => {
    const blur = document.createElement('div');
    blur.classList.add('h-blur');
    document.body.appendChild(blur);
}

const removeBlur = () => {
    const blur = document.querySelector('.h-blur');
    blur.parentNode.removeChild(blur);
}

bioInput.addEventListener('keyup', () => {
    const digit = bioInput.value.length;
    handleBioInput(digit);
});

postInput.addEventListener('keyup', () => {
    const digit = postInput.value.length;
    enablePostCreateSubmit(digit);
});

search.addEventListener('keyup', (e) => {
    handleSearch(search.value, e.keyCode);

});

searchBtn.addEventListener('click', ()=>{
    openSearchfield();
});

commentInput.forEach(field => {
    field.addEventListener('keyup', (event) => {
        handleCommentInput(event);
    });
});

bioUpdateBtn.addEventListener('click', handleShowBioUpdate);

bioCancelBtn.addEventListener('click', (e) => handleCloseBioUpdate(e));

bioSubmitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleBioSubmit();
})

popUpExitBtn.forEach(btn => {
    btn.addEventListener('click', (e) => handleClosePopUp(e));
});

navDropdownBtn.addEventListener('click', (e) => handleDropMenu());

postManageBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.parentElement.parentElement.children[1].id;
        togglePostManager(id);
    });
});
//functional expressions to add event listeners on dynamically created content 
const addCommentManagerEvents = () => {
    const manageBtn = document.querySelectorAll('.js-comment-menu-btn');
    manageBtn.forEach(btn => {
        if (needsEventListener(btn)) {
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.nextElementSibling.id;
                toggleCommentManager(id);
            });
        }
    });
}

const addCommentLikeEvents = () => {
    const likeBtn = document.querySelectorAll('.js-comment-like');
    likeBtn.forEach(btn => {
        if (needsEventListener(btn)) {
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-likes');
                handleLikedComment(id);
            });
        }
    });
}

const addCommentDeleteEvents = () => {
    const deleteBtn = document.querySelectorAll('.js-comment-delete-btn');
    deleteBtn.forEach(btn => {
        if (needsEventListener(btn)) {
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.parentElement.id;
                openCommentDeleteForm(id);
            });
        }
    });
}

const addCommentUpdateEvents = () => {
    const updateBtn = document.querySelectorAll('.js-comment-update-btn');
    updateBtn.forEach(btn => {
        if (needsEventListener(btn)) {
            btn.setAttribute('data-event-click', 'is set');
            btn.addEventListener('click', () => {
                const id = btn.parentElement.id;
                openCommentUpdateForm(id);
            });
        }
    });
}

const needsEventListener = (btn) => {
    return btn.getAttribute('data-event-click') == 'is set' ? false : true;
}

const renderUpdatedComment = (id, value) => {
    const comment = document.querySelector(`[data-text="${id}"]`);
    comment.textContent = value;
    handleClosePopUp();
}

const renderUpdatedPost = (id, value, file) => {
    const text = document.querySelector(`[data-msg="${id}"]`);
    text.textContent = value;
    if (file) {
        renderPhoto(file, renderPostPhoto, id);
    }
    handleClosePopUp();
}

const uploadContent = (id, value, API_ENDPOINT, callback, file = 0, previousPhotoPath = 0) => {
    const request = new XMLHttpRequest();
    const formData = new FormData();

    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            callback();
        }
    };
    formData.append("previousPhoto", previousPhotoPath);
    formData.append("file", file);
    formData.append("msg", value);
    formData.append('id', id);
    request.send(formData);
}

const handleCommentUpdate = () => {
    const id = commentUpdateBtn.getAttribute('value');
    const value = document.querySelector('.js-comment-update-field').value;
    const API_ENDPOINT = "./includes/commentUpdate.inc.php";
    uploadContent(id, value, API_ENDPOINT, () => {
        renderUpdatedComment(id, value)
    })
}

const handlePostUpdate = () => {
    const id = postSubmitBtn.value;
    const value = postInput.value;
    const API_ENDPOINT = "./includes/postUpdate.inc.php";
    const file = document.querySelector('.js-post-img-btn').files[0];
    if(file !== undefined){
        const photo = document.querySelector(`[data-img="${id}"]`);
        if (photo) {
            const previousPhotoPath = photo.getAttribute("data-img-path");
    
            uploadContent(id, value, API_ENDPOINT, () => {
                renderUpdatedPost(id, value, file)
            }, file, previousPhotoPath)
        } else {
            uploadContent(id, value, API_ENDPOINT, () => {
                renderUpdatedPost(id, value, file)
            }, file)
        }
    }else{
        uploadContent(id, value, API_ENDPOINT, () => {
            renderUpdatedPost(id, value, file)
        })
    }
}

const clearCommentInput = (id) => {
    const input = document.querySelector(`[data-comment-submit=\"${id}\"]`);
    input.value = '';
    const btn = document.querySelector(`[value="${id}"]`);

    btn.classList.remove('h-comment-submit-btn');
}

const renderComment = id => {
    clearCommentInput(id);
    loadComments(id);
    let commentStats = document.querySelector(`[data-comments="${id}"]`);

    commentStats.textContent = `${parseInt(commentStats.textContent.split(' ')[0]) + 1} komentarai`;
    if (commentStats.classList.contains('h-hide')) {
        commentStats.classList.remove('h-hide');
    }
}

const createComment = (id, comment) => {
    const API_ENDPOINT = "./includes/commentCreate.inc.php";
    const request = new XMLHttpRequest();
    const formData = new FormData();

    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            renderComment(id);
        }
    };
    formData.append("comment", comment);
    formData.append('id', id);
    request.send(formData);
}

const adjustCommentStatistics = id => {
    let stats = document.querySelector(`[data-comments="${id}"]`);
    const total = parseInt(stats.textContent.split(' ')[0]) - 1;
    stats.textContent = `${total} komentarai`;
    if (total === 0) {
        stats.classList.add('h-hide');
    }
}

const deleteComment = id => {
    const comment = document.querySelector(`[data-comment-id="${id}"]`);
    if (!comment) return;
    const postId = comment.parentElement.getAttribute('data-id');
    comment.parentElement.removeChild(comment);

    adjustCommentStatistics(postId);
    handleClosePopUp();
}

const deletePost = id => {
    const post = document.querySelector(`[data-post="${id}"]`);
    if (!post) return;
    post.parentElement.removeChild(post);
    handleClosePopUp();
}

const deleteContent = (API_ENDPOINT, id, callback, previousPhotoPath = 0) => {
    const request = new XMLHttpRequest();
    const formData = new FormData();

    request.open("POST", API_ENDPOINT, true);
    request.onreadystatechange = () => {
        if (request.readyState === 4 && request.status === 200) {
            callback();
        }
    };
    formData.append('previousPhoto', previousPhotoPath)
    formData.append('id', id);
    request.send(formData);
}

const isClickedUpdateBtn = () => {
    return postSubmitBtn.textContent === "Išsaugoti" ? true : false;
}

const handleDeleteContent = (btn) => {
    const API_ENDPOINT = btn.parentElement.getAttribute('action');
    const id = btn.value;
    if (API_ENDPOINT === "./includes/postDelete.inc.php") {
        let previousPhotoPath = 0;
        const image = document.querySelector(`[data-img="${id}"]`);
        if (image) {
            previousPhotoPath = image.getAttribute('data-img-path');
        }
        deleteContent(API_ENDPOINT, id, () => {
            deletePost(id)
        }, previousPhotoPath);
    } else if (API_ENDPOINT === "./includes/commentDelete.inc.php") {
        deleteContent(API_ENDPOINT, id, () => {
            deleteComment(id)
        });
    }
}

navSelectBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        handleSelectNavBtn(btn.id);
    });
});

postSubmitBtn.addEventListener('click', (e) => {
    if (isClickedUpdateBtn()) { //not create
        e.preventDefault();
        handlePostUpdate();
    }
})

postImageBtn.addEventListener('change', showFileName);

coverUploadPhotoBtn.addEventListener('change', () => {
    const file = coverUploadPhotoBtn.files[0];
    renderPhoto(file, renderCoverPhoto);
});

profileUploadPhotoBtn.addEventListener('change', () => {
    const file = profileUploadPhotoBtn.files[0];
    renderPhoto(file, renderProfilePhoto);
});

postCancelImgBtn.addEventListener('click', (e) => handleCancelImagePost(e));

postCreateBtn.forEach(btn => {
    btn.addEventListener('click', renderCreatePost)
});

postUpdateBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const message = btn.parentElement.parentElement.children[2].textContent;
        const id = btn.parentElement.id;
        const img = btn.parentElement.parentElement.children[3].getAttribute('src');
        handleOpenUpdatePostPopup(message, img, id);
    });
});

postDeleteBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.parentElement.id;
        handleOpenDeletePostPopup(id);
    });
});

postLikeBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.parentElement.parentElement.children[1].id;
        handleLikedPost(id);
    });
});

commentToggleBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-comments');
        handleCommentsMenuToggle(id);
    });
});

commentUpdateBtn.addEventListener('click', (e) => {
    e.preventDefault();
    handleCommentUpdate();
});

commentCreateBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const postId = btn.value;
        const comment = btn.previousElementSibling.value;
        createComment(postId, comment);
    });
});

commentDeleteBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        handleDeleteContent(btn);
    })
})

const renderUserLikes = ids => {
    ids.forEach(id => {
        const btn = document.querySelector(`[data-likes="${id}"]`);
        if (btn) {
            btn.classList.add('h-color');
        }
    });
}

const handleActiveUserLikes = json => {
    const postIds = Object.keys(json).map((key) => json[key] == "Posts" ? key : "").filter(key => key);
    const commentIds = Object.keys(json).map((key) => json[key] == "Comments" ? key : "").filter(key => key);
    renderUserLikes(postIds);
    // Comments' likes cannot be rendered yet because comment boxes are not rendered at this point. Thus the comments with likes are saved in local storage to be used when comment boxes are being opened
    LocalStorage.addComments(commentIds);
}

const fetchLikes = () => {
    const id = 123;
    $.ajax({
        url: "./includes/postFetchReaction.inc.php",
        method: "POST",
        data: {
            id: id
        },
        dataType: "text",
        success: (data) => {
            const json = JSON.parse(data);
            handleActiveUserLikes(json);
        },
        error: (XMLHttpRequest, textStatus, errorThrown) => {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });
}

autocompleteCloseBtn.addEventListener('click', closeAutocomplete);

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fetchLikes);
} else {
    fetchLikes();
}

coverToggleMenuBtn.addEventListener('click', (e) => {
    if (e.target.classList.contains('js-cover-btn') || e.target.classList.contains('c-hero__cover-btn')) {
        handleAddCover();
    }
});