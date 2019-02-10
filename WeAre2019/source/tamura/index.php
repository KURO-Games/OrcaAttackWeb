<html>
<head>
<title>オルカアタック田村航海SourceCord</title>
<link rel="stylesheet" type="text/css" href="../coresys/default.css">
<link rel="stylesheet" href="../coresys/highlight/styles/monokai.css">
<script src="../coresys/highlight/highlight.pack.js"></script>
</head>
<body>
<h1>オルカアタックソースコード 田村航海</h1>
<h2>OrcaManager2.cs</h2>
<pre><code class="cs">using System.Collections;using System.Collections.Generic;using UnityEngine;using UnityEngine.UI;

public class OrcaManager2 : MonoBehaviour
{
    Vector3 worlddir=new Vector3(0,-5f,16.1f), mouseposition, firsttouch = new Vector3(0, -5f, 16.1f), secondrelease, thr, pos, mod = new Vector3(), point = new Vector3(), orcafirstpos = new Vector3(0, -5f, 16.1f);
    [SerializeField] private GameObject Orca;
    [SerializeField] private float OrcaSpeed = 1f, orcahippari = 100f, modori = 1f * -1;
    [SerializeField] public static bool orcayoko, orcatate, orcamodori;
    private Camera cam; bool botton = false;
    public static string Nam;
    [SerializeField]
    private float touchpanel;
    [SerializeField]
    private float OrcaPositionTop, OrcaPositionBottom;
    void Start() { cam = Camera.main; mouseposition = Vector3.zero; worlddir = Vector3.zero; orcayoko = true; orcatate = false; }
    void Update()
    {
        Touchpanel(); Mousehantei(); modoriins();
        //Debug.Log("Y"+orcayoko+" T"+orcatate+" F"+firsttouch+" S"+secondrelease+" W"+worlddir+" M"+mouseposition+" O"+Orca.transform.localPosition);
        if (orcayoko == true && orcatate == false) OrcaYokoIdo();
        if (orcatate == true && orcayoko == false) OrcaTateIdo();
        OrcaPos();

    }
    /// <summary>
    /// Touchpanel this instance.
    /// </summary>
    private void Touchpanel()
    {
        mouseposition = Input.mousePosition;
        if (Input.GetMouseButtonDown(0))
        {
            worlddir = Camera.main.ScreenToWorldPoint(new Vector3(mouseposition.x, mouseposition.y, 16.1f));
            if (worlddir.y <= -13.1) botton = true;
            else botton = false;
        }
        if (Input.GetMouseButton(0)) worlddir = Camera.main.ScreenToWorldPoint(new Vector3(mouseposition.x, mouseposition.y, 16.1f));
        if (Input.GetMouseButtonUp(0)) botton = false;
    }
    /// <summary>
    /// Orca横移動
    /// </summary>
    void OrcaYokoIdo()
    {
        if (Input.GetMouseButton(0))
        {
            if (botton != true)
            {
                //worlddir.y = -9f; 
                Orca.transform.localPosition = new Vector3(worlddir.x, -9f, 16.1f);
            }
        }
    }
    /// <summary>
    /// Orca縦移動
    /// </summary>
    void OrcaTateIdo()
    {
        if (Input.GetMouseButtonUp(0))
        {
            GetComponent<Rigidbody>().AddForce(new Vector3(thr.x * orcahippari, thr.y * orcahippari, 0));
        }
    }
    /// <summary>
    /// Mouse取得(Update)
    /// </summary>
    void Mousehantei()
    {
        if (Input.GetMouseButtonDown(0))
        {//各判定mouseのposition(first)
            firsttouch.x = mouseposition.x; firsttouch.y = mouseposition.y; firsttouch.z = 0;
        }
        if (Input.GetMouseButton(0))
        {//各判定mouseのposition(second)
            secondrelease.x = mouseposition.x; secondrelease.y = mouseposition.y; secondrelease.z = 0;
        }
        if (Input.GetMouseButtonUp(0))
        {//各判定mouseのposition_vector3(final)
            thr = firsttouch - secondrelease;
        }
    }
    /// <summary>
    /// オルカ戻り処理
    /// </summary>
    public void modoriins()
    {
        pos = Orca.transform.position;
        if (orcamodori == true)
        {
            if (Input.GetMouseButtonDown(0))
            {
                if (pos.y >= -9f)
                {
                    pos.y -= modori; Orca.transform.localPosition = pos;
                }
                else
                {
                    orcayoko = true; orcamodori = false;
                }
            }
        }
    }
    /// <summary>
    /// オルカコライダー
    /// </summary>
    /// <param name="collision">Collision.</param>
    private void OnCollisionEnter(Collision collision)
    {
        if (collision.gameObject.name == "orcaWall")
        {
            orcatate = false; orcayoko = false; orcamodori = true;
        }
    }
    /// <summary>
    /// タッチパネル判定
    /// </summary>
    /// 
 /*
    private void TouchpanelCheck()
    {
        if (thr.y <= touchpanel)
        {
            orcatate = true; orcayoko = false;
        }
        else
        {
            orcatate = false; orcayoko = true;
        }
    }
*/

    private void OrcaPos()
    {
        orcafirstpos = Camera.main.ScreenToWorldPoint(new Vector3(0, Input.mousePosition.y, 0));
        Debug.Log(worlddir);
        if (Input.GetMouseButtonDown(0))
        {
            if (orcamodori == false)
            {

                if (worlddir.y >= OrcaPositionTop)
                {
                    orcatate = true; orcayoko = false;
                }
                else
                {
                    orcatate = false; orcayoko = true;
                }
            }
            else orcatate = false;
        }
    }
}
</code></pre>
</br>
<h2>OrcaButtonManage.cs</h2>
<pre><code class="cs">using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class OrcaButtonManager : MonoBehaviour {
    public bool buttonPush = false;
    [SerializeField]
    private Text text;
    private GameObject omanege;
    
// Use this for initialization
void Start () {
        text.text = "決定";
        omanege = GameObject.Find("OrcaPrefab");
}

// Update is called once per frame
void Update () {

}
    public void buttonClick(){
        if (buttonPush == false)
        {
            buttonPush = true;
            text.text = "キャンセル";
            OrcaManager2.orcatate = true;
            OrcaManager2.orcayoko = false;
        }else {
            buttonPush = false;
            text.text = "決定";
            OrcaManager2.orcatate = false;
            OrcaManager2.orcayoko = true;
        }
    }
    
}
</code></pre>
</br>
<h2>ScoreBoard.cs</h2>
<pre><code class="cs">using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using DG.Tweening;
using UnityEngine.SceneManagement;
using UnityEngine.UI;


/// <summary>
/// Score board Controller.
/// </summary>
public class ScoreBoard : MonoBehaviour {
    /// <summary>
    /// The HpController.
    /// </summary>
    HpController hpController;
    /// <summary>
    /// The object score board.
    /// </summary>
    [SerializeField]
    GameObject Object_ScoreBoard;
    ScoreController scoreController;
    [SerializeField]
    GameObject[] Num;
    [SerializeField]
    int OnemoreScene, TitleScene;
    protected int num;
    [SerializeField]
    private Sprite[] numSprite;
    bool end = false;
    [SerializeField]
    GameObject button1, button2;
    // Use this for initialization
    /// <summary>
    /// Start this init.
    /// </summary>
    void Start () {
        hpController = GetComponent<HpController>();
        scoreController = GetComponent<ScoreController>();
}

    // Update is called once per frame
    /// <summary>
    /// 判定文
    /// </summary>
    void Update()
    {
        if (end == false)
        {
            num = scoreController.ScoreSend();
        }
    }
    /// <summary>
    /// Scores the board move.
    /// </summary>
    /// <param name="mov">0 to <see langword="true"/> and 1 to false</param>
    private void ScoreBoardMove(int mov)
    {
        if (mov == 0)//true
        {
            end = true;
            this.gameObject.GetComponent<RectTransform>().DOLocalMoveY(0,1f)
            .OnComplete(() => {
                for (int i = 0; i <= 120; i++)
                {
                    randomnumber();
                }
                View(num);
                button1.gameObject.SetActive(true);
                button2.gameObject.SetActive(true);
            });
        }
        else if(mov == 1)//false
        {

            this.gameObject.GetComponent<RectTransform>().DOLocalMoveY(-1000, 1f).OnComplete(() => {
                num = 0;
                //ScoreController.score = 0;
                button1.gameObject.SetActive(false);
                button2.gameObject.SetActive(false);
            });
        }

    }
    private int randomrange()
    {
        return Random.Range(0, 9);
    }
    private void randomnumber()
    {
        int random = randomrange();
        View(random);

    }
    void View(int score)
    {
        var digit = score;

        List<int> number = new List<int>();
        while (digit != 0)
        {
            score = digit % 10;
            digit = digit / 10;
            number.Add(score);
        }
        GameObject.Find("num").GetComponent<Image>().sprite = numSprite[number[0]];
        for (int i = 1; i < number.Count; i++)
        {

            RectTransform scoreimage = (RectTransform)Instantiate(GameObject.Find("num")).transform;
            scoreimage.SetParent(this.transform, false);
            scoreimage.localPosition = new Vector2(scoreimage.localPosition.x - scoreimage.sizeDelta.x * i,scoreimage.localPosition.y);
            scoreimage.GetComponent<Image>().sprite = numSprite[number[i]];
        }
    }
    public void OneMore()
    {
        ScoreBoardMove(1);
        
    }
    public void Title()
    {
        SceneManager.LoadScene(TitleScene);
    }

}
</code></pre>
</br>
<h3>
<a target="_blank" href="https://github.com/KURO-Games/OrcaAttack" color="skyblue">Github</a>
</h3>
</body>
</html>
