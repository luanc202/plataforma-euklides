using UnityEngine;
using System.Collections;
using UnityEngine.UI;

public class PickupCoin : MonoBehaviour {
    
    void OnTriggerEnter2D(Collider2D other) {
        if (other.gameObject.CompareTag("Player")) {
            AtualizaTexto();
            Destroy(gameObject);
        }
    }

    private void AtualizaTexto() {
        //gameController.instance.score++;
    }
}
