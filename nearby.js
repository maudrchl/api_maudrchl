(function(){var
$containers=document.getElementsByName('lkr-nearby-widget');var $_={footer:{height:0},root:'https://api.lookr.com',webcam:{width:300,height:300}};var render=function(){for(var c=0;c<$containers.length;c++){var
$container=$containers[c],$iframe=document.createElement('iframe');var
params=JSON.parse($container.getAttribute('data-params'))||{};$container.style.display='block';var
availableWidth=$container.offsetWidth||0,number=Math.ceil(availableWidth/$_.webcam.width);if(number<2)
number=2;$iframe.frameBorder='0';$iframe.src=$_.root+'/widget/nearby/@'+params.lat+';'+params.lng+'/'+number;$iframe.style.height=($_.webcam.height+$_.footer.height)+'px';$iframe.style.width='100%';$container.parentNode.replaceChild($iframe,$container);}};render();})();
