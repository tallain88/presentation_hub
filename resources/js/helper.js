export const getPermissions = () => {
    if (navigator.mediaDevices === undefined) {
        navigator.mediaDevices = {};
    }

    // Add getUserMedia if it doesn't exist
    if (navigator.mediaDevices.getUserMedia === undefined) {
        navigator.mediaDevices.getUserMedia = function(constraints) {

            // Get legacy getUserMedia
            const getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

            //return error if not present
            if (!getUserMedia) {
                return Promise.reject(
                    new Error("getUserMedia not available for this browser")
                );
            }

            // return old userMedia
            return new Promise((resolve, reject) => {
                getUserMedia.call(navigator, constraints, resolve, reject);
            });

        }
    }

    // get newer versions
    navigator.mediaDevices.getUserMedia = 
        navigator.mediaDevices.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia;


    return new Promise((resolve, reject) => {
        navigator.mediaDevices
            .getUserMedia({video: true, audio: true}) //get video and audio
            .then (presentationStream => {
                resolve(presentationStream);
            })
            .catch(error => {
                reject(error);
            });
    });
}

