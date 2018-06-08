const isOnWindow = (element) => {
    let window = $(window)
    let scrtop = window.scrollTop()
    let screenBottom = scrtop + window.height()
    let elementTop = element.offset().top
    let elementBottom = elementTop + element.height()

    return elementBottom > screenTop && elementTop < screenBottom;   
}

$(document).ready(() => {
    let loading = false
    $(document).on('scroll', () => {
        console.log('This window is in scroll')
    })
})
