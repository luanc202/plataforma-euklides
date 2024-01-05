using UnityEngine;
using System.Collections;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class Enemy : MonoBehaviour {
    public float velocidade = 1;
    public float tempoMovimento = 0f;
    public float direcao = 1f;
    //public Text texto ;

    // Use this for initialization
    void Start () {
	
	}

    void OnCollisionEnter2D(Collision2D colisor) {
        if (colisor.gameObject.tag == "Player") {
            SceneManager.LoadScene("scene");
            gameController.nBackgrounds = 1;
            //texto.text = "0";
            Destroy(gameObject);
        }
    }
   
    // Update is called once per frame
    void Update () {
        Movimentar();
	}

    void Movimentar() {
        tempoMovimento += Time.deltaTime;
        if (tempoMovimento<=2) {
            transform.Translate(direcao*Vector2.right * velocidade * Time.deltaTime);
        }
        else {
            tempoMovimento = 0f;
            direcao *= -1;
        }
    }
}
