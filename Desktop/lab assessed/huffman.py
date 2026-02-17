# Huffman Coding in python
#
# https://www.programiz.com/dsa/huffman-coding
#
#

import math
from collections import defaultdict

# NodeTree class for the 
class NodeTree(object):
    def __init__(self, left=None, right=None):
        self.left = left
        self.right = right

    def children(self):
        return (self.left, self.right)

# Main function implementing huffman coding
def huffman_code_tree(node, left=True, binString=''):
    if type(node) is not NodeTree:
        return {node: binString}
    (l, r) = node.children()
    d = dict()
    d.update(huffman_code_tree(l, True, binString + '0'))
    d.update(huffman_code_tree(r, False, binString + '1'))
    return d

def get_huffman_tree_for(input_data):
    freq = defaultdict(lambda: 0)
    for c in input_data:
        freq[c] += 1

    nodes = sorted(freq.items(), key=lambda x: x[1], reverse=True)

    while len(nodes) > 1:
        (key1, c1) = nodes[-1]
        (key2, c2) = nodes[-2]
        nodes = nodes[:-2]
        node = NodeTree(key1, key2)
        nodes.append((node, c1 + c2))
        nodes = sorted(nodes, key=lambda x: x[1], reverse=True)

    return huffman_code_tree(nodes[0][0])


def encode_into_string(input_data, verbose=False):
    tree = get_huffman_tree_for(input_data)
    compressed = ''
    for element in input_data:
        compressed += tree[element]

    if verbose:
        print(' Char | Huffman code ')
        print('----------------------')
        for char in tree.keys():
            print(' %-4r |%12s' % (char, tree[char]))

    huffman_table = dict()
    for char in tree.keys():
        huffman_table[tree[char]] = char
    return compressed, huffman_table


def decode_compressed_data(compressed_data, table):
    ret = []
    buffer = ''
    while len(compressed_data) > 0:
        buffer += compressed_data[0]
        compressed_data = compressed_data[1:]
        if buffer in table.keys():
            v = table[buffer]
            ret.append(v)
            buffer = ''
    return ret        

