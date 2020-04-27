﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class AnswerButton : MonoBehaviour {

    public Text textoDaResposta;
    private AnswerData answerData;

    private GameController gameController;
    // Start is called before the first frame update
    void Start() {
        gameController = FindObjectOfType<GameController>();
    }

    // Update is called once per frame
    void Update() {
        
    }

    public void Setup(AnswerData data) {
        answerData = data;
        textoDaResposta.text = answerData.textoResposta;
    }

    public AnswerData getData()
    {
        return answerData;
    }

    public void HandleClick()
    {
        gameController.AnswerButtonClicked(answerData.estaCorreta, answerData.textoResposta);
    }

}
