<html>
<head>
<title>オルカアタック小山SourceCord</title>
<link rel="stylesheet" type="text/css" href="../coresys/default.css">
<link rel="stylesheet" href="../coresys/highlight/styles/monokai.css">
<script src="../coresys/highlight/highlight.pack.js"></script>
</head>
<body>
<h1>オルカアタックソースコード 小山</h1>
<h2>feedg.cs</h2>
<pre><code>using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Feedg : MonoBehaviour {
    [SerializeField]
    private float Speed = 2;
    private GameObject player;
    private ScoreController scoreController;
    private HpController Hpcontroller;
    public Randoms randoms;
    void Start() {
        this.player = GameObject.Find("OrcaPrefab");
        scoreController = FindObjectOfType<ScoreController>();
        Hpcontroller = FindObjectOfType<HpController>();
        randoms = FindObjectOfType<Randoms>();
    }
    void Movement()
    {
        transform.Translate(1 * Speed * Time.deltaTime, 0, 0);
        //画面外で反転
        if (transform.position.x <= -7 || transform.position.x >=7)

        {
            Speed = -1 * Speed;
            Vector3 scale = transform.localScale;
            scale.x = -scale.x;
            transform.localScale = scale;
        }
    }
    private void OnCollisionEnter(Collision collision)
    {
        if(collision.gameObject.tag == "Player")
        {
            if (transform.position.y < 11)
            {
                Debug.Log("10");
                //HP回復
                Hpcontroller.CurrentHP(5);
                //スコア追加
                scoreController.AddScore(10);
                //餌生成関数を呼び出し
                randoms.Generate();
            }
            else
            {
                Debug.Log("20");
                //HP回復
                Hpcontroller.CurrentHP(10);
                //スコア追加
                scoreController.AddScore(20);
                //餌生成関数を呼び出し
                randoms.Generate();
            }
            Destroy(gameObject);
        }
    }
    void Update () {
        Movement();
    }
}

</code></pre>
</br>
<h2>HpController.cs</h2>
<pre><code>
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using DG.Tweening;

public class HpController : MonoBehaviour {
    //ç≈ëÂíl
    [SerializeField]
    public int maxHP = 100;
    //åªç›íl
    [SerializeField]
    public float currentHP;
    HpBarController Hp;
    [SerializeField]
    private GameObject ScoreBoard;


    public Button button;
    private void Awake()
    {
        Hp = GetComponent<HpBarController>();
    }
    private void Start()
    {
        button.gameObject.SetActive(false);
        currentHP = maxHP;
    }
    private void Update()
    {
        Hp.HPDown(currentHP,maxHP);
        if (0 <= currentHP)
        {
            currentHP -= Time.deltaTime * 4;
        }else{
            button.gameObject.SetActive(true);
            OrcaManager2.orcatate = false;
            OrcaManager2.orcayoko = false;
            OrcaManager2.orcamodori = false;

        }
    }
    public void CurrentHP(int Heal)
    {
        if (maxHP > currentHP)
        {
            currentHP = currentHP + Heal;
            if (maxHP < currentHP)
            {
                currentHP = maxHP;
            }
        }
    }
}
</code></pre></br>
<h2>Randoms.cs</h2>
<pre><code>
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Randoms : MonoBehaviour
{
    public FeedGenerator feedGenerator;
    public EsaController esaController;
    public GomiSpawn gomiSpawn;
    public int GarbageCounter = 0;

    public void Generate()
    {
        int x = Random.Range(1, 10000);

        if (x <= 3000)
        {
            //ç∑Çµë÷Ç¶óp
            feedGenerator.Spawn();
            Debug.Log("âa1\n" + x);
        }
        else if (3000 < x && x <= 6000)
        {
            //ç∑Çµë÷Ç¶óp
            feedGenerator.Spawn();
            Debug.Log("âa2\n" + x);
        }
        else if (6000 < x && x <= 9000)
        {
            //ç∑Çµë÷Ç¶óp
            feedGenerator.Spawn();
            Debug.Log("âa3\n" + x);
        }
        else if (9000 < x && x <= 9700 && GarbageCounter <= 3)
        {
            GarbageCounter++;
            gomiSpawn.Spawn();
            Debug.Log("ÉSÉ~\n" + x + "\n" + GarbageCounter);
        }
        else if (9700 < x && x <= 10000 && GarbageCounter <= 3)
        {
            GarbageCounter++;
            gomiSpawn.Spawn();
            Debug.Log("ÉSÉ~\n" + x + "\n" + GarbageCounter);
        }
        else
        {
            feedGenerator.Spawn();
        }
    }
    private void Start()
    {
        for (int i = 0; i < 8; i++)
        {
            Generate();
        }
    }
}
</code></pre></br>
<h2>wall.cs</h2>
<pre><code>
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using DG.Tweening;

public class wall : MonoBehaviour
{
    private GameObject player;
    void Start()
    {
        this.player = GameObject.Find("OrcaPrefab");
    }
    void OnCollisionEnter(Collision collision)
    {
        if (collision.gameObject.tag == "Player")
        {
            Move();
        }
    }
    void Move()
    {
        player.gameObject.transform.DOMove(
            new Vector3(0, -9, 16.1f), 2.0f);
        player.GetComponent<Rigidbody>().velocity = Vector3.zero;
    }
}
</code></pre></br><h3>
<a target="_blank" href="https://github.com/KURO-Games/OrcaAttack" color="skyblue">Github</a>
</h3>
</body>
</html>
