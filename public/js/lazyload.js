document.addEventListener("DOMContentLoaded", function() {
  const lazyBackgrounds = document.querySelectorAll('.lazy-bg');
    console.log('DOMContentLoaded');
  if ("IntersectionObserver" in window) {
    console.log('IntersectionObserver');
    let observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          let div = entry.target;
           console.log('div');
           console.log(div);
          const bgUrl = div.dataset.bg;
           console.log('bgUrl');
           console.log(bgUrl);
          if (bgUrl) {
            div.style.backgroundImage = `url('${bgUrl}')`;
            observer.unobserve(div);
          }
        }
      });
    });

    lazyBackgrounds.forEach(div => {
      observer.observe(div);
    });
  } else {
    // fallback: загрузить фон сразу
    console.log('else IntersectionObserver');
    lazyBackgrounds.forEach(div => {
      const bgUrl = div.dataset.bg;
      if (bgUrl) {
        div.style.backgroundImage = `url('${bgUrl}')`;
      }
    });
  }
});
