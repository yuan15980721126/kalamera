var SiteUrl = "https://"+window.location.host+"/shop";
var ApiUrl = "https://"+window.location.host+"/mobile";
var pagesize = 10;
var WapSiteUrl = "https://"+window.location.host+"/wap";
var IOSSiteUrl = "https://"+window.location.host+"/app.ipa";//"https://vinocave.com/app.ipa";
var AndroidSiteUrl = "https://"+window.location.host+"/app.apk";//"https://vinocave.com/app.apk";

// auto url detection
(function() {
    var m = /^(http?:\/\/.+)\/wap/i.exec(location.href);
    if (m && m.length > 1) {
        SiteUrl = m[1] + '/shop';
        ApiUrl = m[1] + '/mobile';
        WapSiteUrl = m[1] + '/wap';
    }
})();
