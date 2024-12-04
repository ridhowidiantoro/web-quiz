let currentQuestionIndex = 0;
let score = 0;
let playerData = {};
let timerInterval;
let timeLeft = 30;

const questions = [
    { question: "What is 2 + 2?", type: "multiple", options: ["3", "4", "5"], answer: "4", points: 5 },
    { question: "What is the capital of France?", type: "multiple", options: ["Berlin", "Paris", "Rome"], answer: "Paris", points: 5 },
    { question: "Fill in the blank: The sun rises in the ___", type: "text", answer: "east", points: 5 },
    { question: "What is 5 * 3?", type: "text", answer: "15", points: 5 },
    { question: "Which planet is known as the Red Planet?", type: "multiple", options: ["Earth", "Mars", "Venus"], answer: "Mars", points: 5 },
];

function startQuiz() {
    showPage("inputData");
}

function submitPlayerData() {
    playerData.name = document.getElementById("name").value;
    playerData.nim = document.getElementById("nim").value;

    if (playerData.name && playerData.nim) {
        showPage("quizPage");
        loadQuestion();
        renderQuestionNav();
    } else {
        alert("Please fill in all details.");
    }
}

function loadQuestion() {
    clearInterval(timerInterval);
    timeLeft = 30; 
    startTimer();

    const question = questions[currentQuestionIndex];
    const questionContainer = document.getElementById("questionContainer");
    questionContainer.innerHTML = `<h3>${question.question}</h3>`;

    if (question.type === "multiple") {
        question.options.forEach(option => {
            questionContainer.innerHTML += `<label><input type="radio" name="answer" value="${option}"> ${option}</label><br>`;
        });
    } else if (question.type === "text") {
        questionContainer.innerHTML += `<input type="text" id="textAnswer" placeholder="Your Answer">`;
    }

    document.getElementById("currentQuestion").textContent = currentQuestionIndex + 1;
    document.getElementById("totalQuestions").textContent = questions.length;

    highlightCurrentQuestion();
}

function nextQuestion() {
    checkAnswer();
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        loadQuestion();
    } else {
        endQuiz();
    }
}

function prevQuestion() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        loadQuestion();
    }
}

function checkAnswer() {
    const question = questions[currentQuestionIndex];
    let userAnswer = "";

    if (question.type === "multiple") {
        userAnswer = document.querySelector("input[name='answer']:checked")?.value;
    } else if (question.type === "text") {
        userAnswer = document.getElementById("textAnswer").value;
    }

    if (userAnswer && userAnswer.toLowerCase() === question.answer.toLowerCase()) {
        score += question.points;
    }
}

function startTimer() {
    document.getElementById("timer").textContent = `Time: ${timeLeft}s`;
    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById("timer").textContent = `Time: ${timeLeft}s`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            nextQuestion();
        }
    }, 1000);
}

function renderQuestionNav() {
    const questionNav = document.getElementById("questionNav");
    questionNav.innerHTML = ""; 

    questions.forEach((_, index) => {
        const btn = document.createElement("button");
        btn.textContent = index + 1;
        btn.onclick = () => goToQuestion(index);
        questionNav.appendChild(btn);
    });
}

function goToQuestion(index) {
    currentQuestionIndex = index;
    loadQuestion();
}

function highlightCurrentQuestion() {
    const buttons = document.getElementById("questionNav").getElementsByTagName("button");
    Array.from(buttons).forEach((btn, idx) => {
        btn.classList.toggle("active", idx === currentQuestionIndex);
    });
}

function endQuiz() {
    clearInterval(timerInterval);
    showPage("resultPage");
    document.getElementById("resultName").textContent = playerData.name;
    document.getElementById("resultNIM").textContent = playerData.nim;
    document.getElementById("resultScore").textContent = score;
    document.getElementById("Nama").value = playerData.name;
    document.getElementById("Nim").value = playerData.nim;
    document.getElementById("Total_score").value = score;
}

function resetQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    playerData = {};
    clearInterval(timerInterval);
    showPage("home");
}

function showPage(pageId) {
    document.querySelectorAll(".container").forEach(page => {
        page.classList.add("hidden");
        page.classList.remove("active");
    });
    document.getElementById(pageId).classList.remove("hidden");
    document.getElementById(pageId).classList.add("active");
}