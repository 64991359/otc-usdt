const getExplorer = (function(window) {
  const explorer = window.navigator.userAgent
  const compare = function(s) {
    return (explorer.indexOf(s) >= 0)
  }
  const ie11 = (function() {
    return ('ActiveXObject' in window)
  })()
  if (compare('MSIE') || ie11) {
    return 'ie'
  } else if (compare('Firefox') && !ie11) {
    return 'Firefox'
  } else if (compare('Chrome') && !ie11) {
    return 'Chrome'
  } else if (compare('Opera') && !ie11) {
    return 'Opera'
  } else if (compare('Safari') && !ie11) {
    return 'Safari'
  }
})(window)

if (window.location.pathname.indexOf("/notSupport") === -1 && getExplorer === 'ie') {
  window.location = '/notSupport'
}


