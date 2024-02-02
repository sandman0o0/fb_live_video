async function get_latest_live() {
  const response = await fetch("json/latest_video.json");
  const live_video = await response.json();
//  console.log(live_video.latest_url);

  document.getElementById("live_video_stream")
    .innerHTML += "<iframe allow=\"autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share\" width=\"560\" height=\"315\" src=\""+live_video.latest_url+"\"></iframe>";
}
