let song;
const context = new AudioContext();
let currentSource = null; // Zmienna do przechowywania aktualnie odtwarzanego źródła
let currentlyPlayingAudioPath = null;

function splitTime(timeString){
    const parts = timeString.split(":").map(Number);
    const [hours, minutes, seconds] = parts;
    return hours * 3600 + minutes * 60 + seconds;
}

function setButtonState(buttonId, state) {
    const button = document.getElementById(buttonId);
    if (!button) return;

    button.classList.remove('loading', 'playing');
    button.disabled = false;

    if (state === 'loading') {
        button.classList.add('loading');
        button.disabled = true;
    } else if (state === 'playing') {
        button.classList.add('playing');
    }
}

/**
 * Ładuje plik audio
 */
async function loadAudio(audioPath) {
  try {
    const response = await fetch(audioPath);
    if (!response.ok) {
      throw new Error(`Błąd ładowania pliku audio: ${response.statusText}`);
    }
    const arrayBuffer = await response.arrayBuffer();
    const audioBuffer = await context.decodeAudioData(arrayBuffer);
    return audioBuffer;
  } catch (error) {
    console.error("Nie udało się załadować lub zdekodować pliku audio:", error);
    throw error;
  }
}
const play = (audioPath,buffer, startTime, duration, buttonId) => {

    if (currentSource && currentlyPlayingAudioPath === audioPath) {
        // Jeśli tak, zatrzymaj odtwarzanie
        currentSource.stop();
        currentSource.disconnect();
        currentSource = null;
        currentlyPlayingAudioPath = null; // Resetuj ścieżkę
        console.log(`Zatrzymano odtwarzanie: ${audioPath}`);
        setButtonState(buttonId,"ready");
        return; // Zakończ funkcję, nic więcej nie rób
    }

    // 1. Zatrzymywanie poprzedniego dźwięku, jeśli istnieje
    if (currentSource) {
        currentSource.stop(); // Zatrzymuje aktualnie odtwarzany dźwięk
        currentSource.disconnect(); // Odłącza go od wyjścia, aby zwolnić zasoby
        currentSource = null; // Resetuje referencję
        console.log("Poprzedni dźwięk został zatrzymany.");
    }

     // 2. Tworzenie nowego źródła i odtwarzanie
    const source = context.createBufferSource();
    source.buffer = buffer;
    source.connect(context.destination);
    source.start(context.currentTime, startTime, duration);
    setButtonState(buttonId,'playing');

    // 3. Zapisywanie referencji do nowego źródła
    currentSource = source;
    currentlyPlayingAudioPath = audioPath;

    // Opcjonalnie: Ustaw listener, aby zresetować currentSource po zakończeniu odtwarzania
    // Dźwięk zakończy się albo po duration, albo po końcu bufora, jeśli duration jest większe
    source.onended = () => {
    if (currentSource === source) { // Upewnij się, że to ten sam, który faktycznie się skończył
        currentSource = null;
        console.log("Odtwarzanie zakończone, currentSource zresetowane.");
        setButtonState(buttonId,"ready");
    }
  };
};

async function playPauseState(audioPath, startTime, endTime, buttonId){
    startTime = splitTime(startTime);
    endTime = splitTime(endTime);
    const duration = endTime-startTime;
    setButtonState(buttonId,'loading');
    song = await loadAudio(audioPath);
    play(audioPath,song,startTime,duration,buttonId);
}