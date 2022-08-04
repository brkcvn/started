document.querySelectorAll('.js-border').forEach(function (item) {
    item.addEventListener('focus', clickHover);
    item.addEventListener('blur', blurInput);

    function clickHover() {
        item.style.borderColor = "red";
    }

    function blurInput() {
        item.style.borderColor = "grey";
    }
});

let arr = [
    {
        'title': 'Great! Let’s start!',
        'section':'We will ask you some basic questions to make your business amazing.',
        'image_src': 'img/get-started.jpg',
        'pathname': '/C:/Users/amerv/OneDrive/Masa%C3%BCst%C3%BC/tailwind/started.html'
    },

    {
        'title': 'Hooray!',
        'section':'Let’s create your first company!',
        'image_src': 'img/company-create.jpg',
        'pathname': '/C:/Users/amerv/OneDrive/Masa%C3%BCst%C3%BC/tailwind/hooray.html'
    }
]

for (let i of arr) {
    if (i.pathname == window.location.pathname) {
        document.querySelector('.js-colose').innerHTML =`<img src="${i.image_src}" class="absolute min-h-screen w-full"><div class="absolute h-screen w-full bg-blue-700 opacity-60"></div><div class="absolute text-white p-20"><h1 class="font-bold text-4xl mb-4">${i.title}</h1> <p class="text-sm">${i.section}</p></div>`;
    }

    else if (i.pathname == window.location.pathname) {
        document.querySelector('.js-colose').innerHTML =`<img src="${i.image_src}" class="absolute min-h-screen w-full"><div class="absolute h-screen w-full bg-blue-700 opacity-60"></div><div class="absolute text-white p-20"><h1 class="font-bold text-4xl mb-4">${i.title}</h1> <p class="text-sm">${i.section}</p></div>`;
    }
}

let logo = [
    {
        'logo':'img/akaunting-logo.svg',
        'pathname':'/C:/Users/amerv/OneDrive/Masa%C3%BCst%C3%BC/tailwind/started.html'
    },

    {
        'logo':'img/akaunting-logo-purple.svg',
        'pathname':'/C:/Users/amerv/OneDrive/Masa%C3%BCst%C3%BC/tailwind/hooray.html'
    }
]

for (let j of logo) {
    switch  (window.location.pathname) {
        case j.pathname:
            document.querySelector(".js-logo").innerHTML=`<img src="${j.logo}" alt="Akaunting">`;
            break;
            
        case j.pathname:
            document.querySelector(".js-logo").innerHTML=`<img src="${j.logo}" alt="Akaunting">`;
            break;
    }
}


