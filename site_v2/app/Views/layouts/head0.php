<title>oStream - <?= $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?= $description; ?>">
<meta name="author" content="Hugo L (Owner), Mateo M. (Developer)">
<meta name="revisit-after" content="15">
<meta name="language" content="fr">
  <meta name="copyright" content="© 2016-<?= date('Y'); ?> OStream">
<meta name="image" content="<?= base_url(); ?>/assets/images/logo.png?v=provisoire">
<meta name="robots" content="index,follow" />
<meta name="googlebot" content="index,follow" />
<meta name="googlebot-news" content="index,follow" />
<meta name="og:url" property="og:url" content="<?= base_url(); ?>">
<meta name="og:type" property="og:type" content="website">
<meta name="og:site_name" property="og:site_name" content="oStream">
<meta name="og:title" property="og:title" content="<?= $title; ?>">
<meta name="og:description" property="og:description" content="<?= $description; ?>">
<meta name="og:image" property="og:image" content="<?= base_url(); ?>/assets/images/logo.png?v=provisoire">
<meta name="og:language" property="og:language" content="fr">
<meta name="og:locale" property="og:locale" content="fr">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?= $title; ?>">
<meta name="twitter:description" content="<?= $description; ?>">
<meta name="twitter:image:src" content="<?= base_url(); ?>/assets/images/logo.png?v=provisoire">
<meta name="twitter:url" content="<?= base_url(); ?>">
<meta name="theme-color" content="#7ac32c">
<link rel="apple-touch-icon" href="<?= base_url(); ?>/assets/images/logo.png?v=provisoire">
<link rel="icon" href="<?= base_url(); ?>/assets/images/logo.png?v=provisoire">


<script src="<?= base_url(); ?>/uploads/assets/fontawesome/all.js?v=6.2.0" type="text/javascript"></script>
<!-- CSS bootstrap-->
<link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<!--  Style -->
<link rel="stylesheet" href="<?= base_url('uploads'); ?>/assets/css/style.css?v=2.0" />
<!--  Responsive -->
<link rel="stylesheet" href="<?= base_url('uploads'); ?>/assets/css/responsive.css" />

<script src="<?= base_url('/arc-sw.js'); ?>"></script>
<script async src="https://arc.io/widget.min.js#RTqoWeeb"></script>

<!-- ADS -->
<!-- Quantcast Choice. Consent Manager Tag v2.0 (for TCF 2.0) -->
<script type="text/javascript" async=true>
(function() {
  var host = 'www.themoneytizer.com';
  var element = document.createElement('script');
  var firstScript = document.getElementsByTagName('script')[0];
  var url = 'https://cmp.quantcast.com'
    .concat('/choice/', '6Fv0cGNfc_bw8', '/', host, '/choice.js');
  var uspTries = 0;
  var uspTriesLimit = 3;
  element.async = true;
  element.type = 'text/javascript';
  element.src = url;

  firstScript.parentNode.insertBefore(element, firstScript);

  function makeStub() {
    var TCF_LOCATOR_NAME = '__tcfapiLocator';
    var queue = [];
    var win = window;
    var cmpFrame;

    function addFrame() {
      var doc = win.document;
      var otherCMP = !!(win.frames[TCF_LOCATOR_NAME]);

      if (!otherCMP) {
        if (doc.body) {
          var iframe = doc.createElement('iframe');

          iframe.style.cssText = 'display:none';
          iframe.name = TCF_LOCATOR_NAME;
          doc.body.appendChild(iframe);
        } else {
          setTimeout(addFrame, 5);
        }
      }
      return !otherCMP;
    }

    function tcfAPIHandler() {
      var gdprApplies;
      var args = arguments;

      if (!args.length) {
        return queue;
      } else if (args[0] === 'setGdprApplies') {
        if (
          args.length > 3 &&
          args[2] === 2 &&
          typeof args[3] === 'boolean'
        ) {
          gdprApplies = args[3];
          if (typeof args[2] === 'function') {
            args[2]('set', true);
          }
        }
      } else if (args[0] === 'ping') {
        var retr = {
          gdprApplies: gdprApplies,
          cmpLoaded: false,
          cmpStatus: 'stub'
        };

        if (typeof args[2] === 'function') {
          args[2](retr);
        }
      } else {
        if(args[0] === 'init' && typeof args[3] === 'object') {
          args[3] = { ...args[3], tag_version: 'V2' };
        }
        queue.push(args);
      }
    }

    function postMessageEventHandler(event) {
      var msgIsString = typeof event.data === 'string';
      var json = {};

      try {
        if (msgIsString) {
          json = JSON.parse(event.data);
        } else {
          json = event.data;
        }
      } catch (ignore) {}

      var payload = json.__tcfapiCall;

      if (payload) {
        window.__tcfapi(
          payload.command,
          payload.version,
          function(retValue, success) {
            var returnMsg = {
              __tcfapiReturn: {
                returnValue: retValue,
                success: success,
                callId: payload.callId
              }
            };
            if (msgIsString) {
              returnMsg = JSON.stringify(returnMsg);
            }
            if (event && event.source && event.source.postMessage) {
              event.source.postMessage(returnMsg, '*');
            }
          },
          payload.parameter
        );
      }
    }

    while (win) {
      try {
        if (win.frames[TCF_LOCATOR_NAME]) {
          cmpFrame = win;
          break;
        }
      } catch (ignore) {}

      if (win === window.top) {
        break;
      }
      win = win.parent;
    }
    if (!cmpFrame) {
      addFrame();
      win.__tcfapi = tcfAPIHandler;
      win.addEventListener('message', postMessageEventHandler, false);
    }
  };

  makeStub();

  var uspStubFunction = function() {
    var arg = arguments;
    if (typeof window.__uspapi !== uspStubFunction) {
      setTimeout(function() {
        if (typeof window.__uspapi !== 'undefined') {
          window.__uspapi.apply(window.__uspapi, arg);
        }
      }, 500);
    }
  };

  var checkIfUspIsReady = function() {
    uspTries++;
    if (window.__uspapi === uspStubFunction && uspTries < uspTriesLimit) {
      console.warn('USP is not accessible');
    } else {
      clearInterval(uspInterval);
    }
  };

  if (typeof window.__uspapi === 'undefined') {
    window.__uspapi = uspStubFunction;
    var uspInterval = setInterval(checkIfUspIsReady, 6000);
  }
})();
</script>
<!-- End Quantcast Choice. Consent Manager Tag v2.0 (for TCF 2.0) -->

<script defer src="https://cdn.unblockia.com/h.js"></script>
<style>
*, ::after, ::before {
    box-sizing: border-box;
    z-index: 0;
}
</style>
