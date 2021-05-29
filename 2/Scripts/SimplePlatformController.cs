using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using UnityEngine.SceneManagement;
using UnityEngine.UI;
using UnityEngine.Networking;
using System;

public class SimplePlatformController : MonoBehaviour {

    public float Speed;
    public float JumpForce;
    public float tempoRestante = 180;
    private static float tempoTotal = 0;
    public static int vidas = 3;
    private bool rodadaAtiva;
    private Vector2 posicaoInicial;

    private Rigidbody2D rig;
    public Image vida1;
    public Image vida2;
    public Image vida3;

    public bool isJumping;
    public bool subiuNaPlataforma;

    private string url_parametros;
    private string[] parametros_str;
    private int[] parametros;

    public bool reiniciaContagem = false;

    // Start is called before the first frame update
    void Start()
    {
        posicaoInicial = transform.position;

        //coleta os parametros enviados pela url
        int pm = Application.absoluteURL.IndexOf("?");
         if (pm != -1) {
            url_parametros = Application.absoluteURL.Split("?"[0])[1];
        }
        if (url_parametros != null)
        {
            parametros_str = url_parametros.Split(',');
            parametros = new int[parametros_str.Length];
            for(int i = 0; i < parametros.Length; i++){
                parametros[i] = Int32.Parse(parametros_str[i]);
            }
        }
        
        //verifica se o jogador já subiu alguma vez na plataforma. Irá controlar a perda de vidas quando o jogador cair no chão
        subiuNaPlataforma = false;
        Speed = 5;
        JumpForce = 14.5f;
        rig = GetComponent<Rigidbody2D>();

        rodadaAtiva = true;

        desenhaVidas();
    }

    // Update is called once per frame
    void Update()
    {
        Move();
        Jump();
        if (rodadaAtiva)
        {
            //atualiza as variáveis de tempo
            tempoRestante -= Time.deltaTime;
            tempoTotal += Time.deltaTime;
            //se o tempo tiver acabado e o jogador tiver mais de uma vida
            if(tempoRestante <= 0 && vidas > 1)
            {
                tempoRestante = 180;
                //uma vida é perdida
                perdeVida();
                //chama o método para reiniciar o level
                ReiniciaRound();
            //se o tempo tiver acabado e o jogador só tiver uma vida, ou seja, perdeu o jogo
            } else if (tempoRestante <= 0 && vidas == 1)
            {
                //chama o método para finalizar o jogo
                EndRound();
            //se o número de vidas for igual a 0, ou seja, ele perdeu vidas ao pisar no chão
            } else if (vidas == 0)
            {
                //chama o método para finalizar o jogo
                EndRound();
            }
        }
    }

    void Move() 
    {
        //pega o valor do movimento do personagem -1 (esquerda), 1 (direita)
        Vector3 movement  = new Vector3(Input.GetAxis("Horizontal"), 0f, 0f);
        //soma a posição com o movimento e adiciona uma velocidade também
        transform.position += movement * Time.deltaTime * Speed;
    }

    void Jump()
    {
        //por padrão é o space
        // a variavel isJumping impede o jogador de dar mais de um pulo ao mesmo tempo
        if(Input.GetButtonDown("Jump") && !isJumping)
        {
            rig.AddForce(new Vector2(0f, JumpForce), ForceMode2D.Impulse);
        }
    }

    //faz contato com a plataforma
    void OnCollisionEnter2D(Collision2D collision)
    {
        //9 são as plataformas e 13 é o chão
        if(collision.gameObject.layer == 9 || collision.gameObject.layer == 13)
        {
            isJumping = false;
        } 
        //colidiu com o objetivo
        if (collision.gameObject.layer == 14)
        {
            //se o level for 4, significa que o jogo acabou
            if (gameController.level == 4)
            {
                EndRound();
            } else 
            {
                //como o objetivo foi alcançado, a variável level é incrementada
                gameController.level++;
                //é carregado a cena do próximo level
                SceneManager.LoadScene("Level"+gameController.level);
            }
        }
        //se ele colidiu com a plataforma e a variável for false, significa que ele está pisando na plataforma pela primeira vez
        if (collision.gameObject.layer == 9 && !subiuNaPlataforma)
        {
            subiuNaPlataforma = true;
        }
        //se ele colidiu com o chão e já tiver subido em uma plataforma, significa que ele caiu no chão, então perde uma vida
        if (collision.gameObject.layer == 13 && subiuNaPlataforma)
        {
            //uma vida é perdida
            perdeVida();
            //chama o método para reiniciar o level
            ReiniciaRound();
        }
    }

    void OnCollisionExit2D(Collision2D collision)
    {
        if(collision.gameObject.layer == 9 || collision.gameObject.layer == 13)
        {
            isJumping = true;
        }
    }

    public void perdeVida()
    {
        if (vidas == 3)
        {
            vida1.enabled=false;
        } else if (vidas == 2)
        {
            vida2.enabled=false;
            } else 
            {
                vida3.enabled=false;
            }
        vidas--;
    }

    public void EndRound()
    {
        StartCoroutine(Registro());
        rodadaAtiva = false;
        vidas = 3;
        gameController.level = 1;
        tempoTotal = 0;
        //carregar a cena de finalizar o jogo
        SceneManager.LoadScene("FimJogo");
    }

    IEnumerator Registro(){
        WWWForm form = new WWWForm();
        form.AddField("cod_aluno", parametros[0]);
        form.AddField("cod_sala", parametros[1]);
        form.AddField("cod_jogo", 2);
        form.AddField("tempo_gasto", Mathf.RoundToInt(tempoTotal));
        form.AddField("num_dicas", 0);
        form.AddField("num_acertos", gameController.level);
        form.AddField("num_erros", 3 - vidas);
        form.AddField("level", ""+gameController.level);
        WWW www = new WWW("http:///www.darti.ufma.br/plataforma-euklides/registra_jogada.php", form);
        yield return www;
        if(www.text == "0"){
            Debug.Log("Jogada cadastrada");
        } else{
            Debug.Log("Erro #" + www.text);
        }
    }

    //esgotou o tempo e o jogador perde uma vida e o level reinicia
    public void ReiniciaRound()
    {
       // SceneManager.LoadScene("Level"+gameController.level);
        transform.position = posicaoInicial;
        subiuNaPlataforma = false;
    }

    public void desenhaVidas()
    {
        if (vidas == 2)
        {
            vida1.enabled=false;
        } else if (vidas == 1)
        {
            vida1.enabled=false;
            vida2.enabled=false;
        }
    }
}